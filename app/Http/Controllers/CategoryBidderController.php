<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryBidder;
use Illuminate\Http\Request;

class CategoryBidderController extends Controller
{
    public function index()
    {
        $bidder = CategoryBidder::all();
        return view('pages.bidder.category', compact('bidder'));
    }

    public function detail($code)
    {
        $bidder = CategoryBidder::with('bidder')->where('code', $code)->get();

        if ($bidder) {
            return response()->json([
                'success' => true,
                'data' => $bidder
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy'
        ]);
    }

    public function create(Request $request)
    {
        // CategoryBidder::create([
        //     'code' => $request->code,
        //     'name' => $request->name
        // ]);
        // return redirect()->back();
        return view('pages.bidder.create_category');
    }

    public function store(Request $request)
    {
        CategoryBidder::create([
            'code' => $request->code,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'tk' => $request->tk,
            'tax_code' => $request->tax_code,
            'represent' => $request->represent,
            'gender' => $request->gender,
            'position' => $request->position,
        ]);

        return redirect()->route('category.index');
    }
    //hello mọi người
}
