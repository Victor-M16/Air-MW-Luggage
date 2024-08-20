<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Trip;

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
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string|max:15',
            'ticket_number' => 'required|string|unique:customers,ticket_number',
            'departure_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
        ]);

        // Create a new customer
        $customer = Customer::firstOrCreate($validatedData);


        // Create or find the trip
        $trip = Trip::firstOrCreate(
            [
                'customer_id' => $customer->id,
            ],
            [
                'ticket_number' => $validatedData['ticket_number'],
            ]
        );

        // Redirect to luggage registration
        return redirect()->route('luggage.create', ['customer_id' => $customer->id])
                         ->with('status', 'Customer registered successfully! Please register your luggage, if any.');
    }
}
