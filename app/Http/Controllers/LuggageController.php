<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Bag;
use App\Models\LuggageItem;
use App\Models\Customer;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class LuggageController extends Controller
{
    public function create()
    {
        // Display a list of luggage items or a form to add new items
        return view('luggage.create');
    }

    public function success()
    {
        // Display a list of luggage items or a form to add new items
        return view('luggage.success');
    }

    public function index()
    {
        // Display a list of luggage items or a form to add new items
        return view('luggage.index');
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
    
        // Loop through each bag
        foreach ($validatedData['bags'] as $bagData) {
            $bag = new Bag();
            $bag->bag_description = $bagData['description'];
            $bag->customer_id = $customer->id;
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
    
        return redirect()->route('luggage.index')->with('status', 'Luggage registered successfully!');
    }
    

    public function show($id)
    {
        // Show details of a specific luggage item
        $luggage = LuggageItem::findOrFail($id);
        return view('luggage.show', compact('luggage'));
    }

    public function search(Request $request)
    {
        // Search luggage by surname or ticket number
        $query = $request->input('query');
        $luggage = LuggageItem::where('ticket_number', 'like', '%' . $query . '%')
                              ->orWhere('surname', 'like', '%' . $query . '%')
                              ->get();
        return view('luggage.search', compact('luggage'));
    }



}
