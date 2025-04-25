<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidder;
use App\Models\CategoryBidder;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BidderController extends Controller
{
    public function index()
    {
        $bidders = Bidder::all();
        return view('pages.bidder.index', compact('bidders'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);
        $rows = 0;

        foreach ($data as $index => $row) {
            if ($index === 1 || empty($row['B'])) {
                continue;
            }

            Bidder::create([
                'category_id'   => $row['A'] ?? null,
                'ma_phan'       => $row['B'] ?? null,
                'ten_phan'      => $row['C'] ?? null,
                'product_name'  => $row['D'] ?? null,
                'quantity'      => $row['E'] ?? null,
            ]);

            $rows++;
        }


        return redirect()->back();
    }

    public function create()
    {
        $categories = CategoryBidder::all();
        return view('pages.bidder.create_bidder', compact('categories'));
    }

    public function store(Request $request)
    {
        Bidder::create([
            'category_id'   => $request->category_id ?? null,
            'ma_phan'       => $request->ma_phan ?? null,
            'ten_phan'      => $request->ten_phan ?? null,
            'product_name'  => $request->product_name ?? null,
            'quantity'      => $request->quantity ?? null,
        ]);
        return redirect()->route('bidder.index');
    }
}
