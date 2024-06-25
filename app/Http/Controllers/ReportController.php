<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report($id)
    {
        $product = Product::findOrFail($id);
        return view('reports.report', compact('product')); // Buat view ini
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->product_id = $id;
        $report->reason = $request->reason;
        $report->save();

        return redirect()->route('home')->with('message', 'Produk berhasil dilaporkan');
    }
}

