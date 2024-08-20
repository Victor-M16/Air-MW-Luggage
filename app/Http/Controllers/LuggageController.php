<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Bag;
use App\Models\LuggageItem;
use App\Models\Customer;
use App\Models\Trip;
use Endroid\QrCode\Builder\Builder;


class LuggageController extends Controller
{

    public function index()
    {
        return view('luggage.index');
    }

    public function searchForm()
    {
        return view('luggage.search_form');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search for trips by customer's surname or ticket number
        $trips = Trip::where('ticket_number', 'LIKE', "%{$query}%")
            ->orWhereHas('customer', function ($q) use ($query) {
                $q->where('surname', 'LIKE', "%{$query}%");
            })
            ->with('customer', 'bags.items')
            ->get();
        
        // If you want to show a view with the results
        return view('luggage.search_results', compact('trips'));
    }

    
    public function create(Request $request)
    {
        // $customer = Customer::findOrFail($request->customer_id);
        // return view('luggage.create', compact('customer'));
        return view('luggage.create');
    }

    
    public function store(Request $request)
    {
        Log::info('Request received:', $request->all());
    
        // Validate the request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'ticket_number' => 'required|string',
            'bags.*.description' => 'required|string',
            'bags.*.items.*.char1' => 'required|string',
            'bags.*.items.*.char2' => 'required|string',
            'bags.*.items.*.char3' => 'required|string',
        ]);
    
        // Create or find the customer
        $customer = Customer::firstOrCreate(['email' => $validatedData['email']]);
    
        // Create or find the trip
        $trip = Trip::firstOrCreate(
            [
                'customer_id' => $customer->id,
            ],
            [
                'ticket_number' => $validatedData['ticket_number'],
            ]
        );
    
        // Loop through each bag
        foreach ($validatedData['bags'] as $bagData) {
            $bag = new Bag();
            $bag->bag_description = $bagData['description'];
            $bag->trip_id = $trip->id; // Link the bag to the trip
            $bag->save();
    
            // Loop through each item in the bag
            foreach ($bagData['items'] as $itemData) {
                $luggageItem = new LuggageItem();
                $luggageItem->bag_id = $bag->id;
                $luggageItem->characteristic_1 = $itemData['char1'];
                $luggageItem->characteristic_2 = $itemData['char2'];
                $luggageItem->characteristic_3 = $itemData['char3'];
                $luggageItem->save();
            }
        }
    
        $directory = storage_path('app/public/qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
    
        // Generate the URL for the trip report
        $reportUrl = route('report.show', ['tripId' => $trip->id]);

        //$trip->qr_code = $reportUrl;
    
        // Generate QR Code after luggage registration
        $qrCode = Builder::create()
            ->data($reportUrl) // Encode the report URL
            ->size(300)
            ->margin(10)
            ->build();
    
        // Save the QR code as a file
        $qrCodePath = storage_path('app/public/qrcodes/' . $trip->ticket_number . '.png');
        $qrCode->saveToFile($qrCodePath);
    
        return redirect()->route('luggage.index')->with('status', 'Luggage registered and report generated successfully!');
    }
        
}
