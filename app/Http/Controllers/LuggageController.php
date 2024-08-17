<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bag;
use App\Models\LuggageItem;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class LuggageController extends Controller
{
    public function index()
    {
        // Display a list of luggage items or a form to add new items
        return view('luggage.index');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'departure_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'ticket_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'items' => 'required|array',
            'items.*.description' => 'required|string|max:255',
            'items.*.characteristic1' => 'required|string|max:255',
            'items.*.characteristic2' => 'required|string|max:255',
        ]);

        // Store luggage information
        $luggage = new LuggageItem();
        $luggage->departure_point = $request->departure_point;
        $luggage->destination = $request->destination;
        $luggage->ticket_number = $request->ticket_number;
        $luggage->email = $request->email;
        $luggage->phone = $request->phone;
        $luggage->save();

        foreach ($request->items as $item) {
            $luggage->items()->create($item);
        }

        // Generate QR code
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data('Luggage ID: ' . $luggage->id)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->logoPath(public_path('assets/symfony.png')) // Update the logo path as needed
            ->logoResizeToWidth(50)
            ->logoPunchoutBackground(true)
            ->labelText('Luggage QR Code')
            ->labelFont(new NotoSans(20))
            ->labelAlignment(LabelAlignment::Center)
            ->validateResult(false)
            ->build();

        // Save QR code to a file
        $filePath = 'qrcodes/luggage_' . $luggage->id . '.png';
        $result->saveToFile(public_path($filePath));

        // Provide the path to the QR code image
        $luggage->qr_code_url = $filePath;
        $luggage->save();

        // Return a view with the QR code URL
        return view('luggage.show', ['luggage' => $luggage]);
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
