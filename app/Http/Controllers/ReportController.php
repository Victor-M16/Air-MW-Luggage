<?php


namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Trip;

class ReportController extends Controller{

    public function generatePdf($tripId)
    {
        $trip = Trip::with('customer', 'bags.items')->findOrFail($tripId);
    
        $pdf = PDF::loadView('report.show', compact('trip'));
    
        return $pdf->download('trip-report.pdf');
    }

    public function show($tripId)
    {
        // Retrieve the trip with associated customer, bags, and items
        $trip = Trip::with('customer', 'bags.items')->findOrFail($tripId);
        // Pass the trip details to the view
        return view('report.show', compact('trip'));
    }
}

