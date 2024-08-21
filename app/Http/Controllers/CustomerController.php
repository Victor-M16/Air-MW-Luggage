<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Trip;
use Endroid\QrCode\Builder\Builder;
use Exception;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'departure_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
        ]);

        // Extract data for customer creation
        $customerData = [
            'firstname' => $validatedData['firstname'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
        ];

        // Extract data for trip creation
        $tripData = [
            'departure_point' => $validatedData['departure_point'],
            'destination' => $validatedData['destination'],
        ];

        try {
            // Find the customer or create a new one if they don't exist
            $customer = Customer::firstOrCreate(
                ['email' => $customerData['email']], // Find by email
                $customerData // If not found, create with these attributes
            );

            $ticketNumber = 'TICKET-' . strtoupper(uniqid());

            // Create the trip with the generated ticket number
            $trip = Trip::create([
                'customer_id' => $customer->id,
                'ticket_number' => $ticketNumber,
                'departure_point' => $tripData['departure_point'],
                'destination' => $tripData['destination'],
                'qr_code' => null, // Placeholder for QR code path
            ]);

            // Create the directory if it doesn't exist
            $directory = storage_path('app/public/qrcodes');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // Generate the URL for the trip report
            $reportUrl = route('report.show', ['tripId' => $trip->id]);

            // Generate QR Code
            $qrCode = Builder::create()
                ->data($reportUrl) // Encode the report URL
                ->size(300)
                ->margin(10)
                ->build();

            // Save the QR code as a file
            $qrCodePath = 'qrcodes/' . $trip->ticket_number . '.png'; // Save relative path
            $qrCode->saveToFile(storage_path('app/public/' . $qrCodePath));

            // Save the QR code path in the database
            $trip->qr_code = $qrCodePath;
            $trip->save();

            // Redirect to luggage registration
            return redirect()->route('luggage.create', ['customer_id' => $customer->id])
                             ->with('status', 'Customer registered successfully! Please register your luggage, if any.');

        } catch (Exception $e) {
            // Handle exceptions and errors
            return redirect()->back()
                             ->with('error', 'There was an issue registering the customer: ' . $e->getMessage());
        }
    }
}
