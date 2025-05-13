<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\GroupBidder;
use Illuminate\Http\Request;

class CategoryBidderController extends Controller
{
    public function index()
    {
        $bidder = CategoryBidder::all();
        return view('pages.bidder.category', compact('bidder'));
    }

    public function detail($code, $group)
    {
        $categoryBidder = CategoryBidder::with(['bidder' => function ($query) use ($group) {
            $query->where('ma_dau_thau', $group);
        }])->where('code', $code)->first();

        if (!$categoryBidder) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy nhà thầu với mã này'
            ]);
        }

        if ($categoryBidder->bidder->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy nhà thầu thuộc mã đấu thầu này'
            ]);
        }

        $groupBidder = GroupBidder::where('id', $group)
            ->where('category_id', $code)
            ->first();

        if (!$groupBidder) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy nhóm đấu thầu phù hợp'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'bidder' => $categoryBidder,
                'group_bidder' => $groupBidder
            ]
        ]);
    }

    public function create(Request $request)
    {
        // CategoryBidder::create([
        //     'code' => $request->code,
        //     'name' => $request->name
        // ]);
        // return redirect()->back();
        $cities = City::all();
        return view('pages.bidder.create_category', compact('cities'));
    }

    public function store(Request $request)
    {
        CategoryBidder::create([
            'code' => $request->code,
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'tk' => $request->tk,
            'tax_code' => $request->tax_code,
            'represent' => $request->represent,
            'gender' => $request->gender,
            'position' => $request->position,
        ]);

        return redirect()->route('category.index')->with('success', 'Thêm mới thành công');
    }
}
