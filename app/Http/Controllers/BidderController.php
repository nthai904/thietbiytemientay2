<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\GroupBidder;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BidderController extends Controller
{
    public function index()
    {
        $bidders = Bidder::with('category', 'group')->orderBy('created_at', 'desc')->get()->groupBy('ma_dau_thau');
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


        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    public function create()
    {
        $cities = City::all();
        return view('pages.bidder.create_bidder', compact('cities'));
    }

    public function edit($id)
    {
       $bidder = Bidder::with('category', 'group')->where('ma_dau_thau', $id)->get()->groupBy('ma_dau_thau');
       $cities = City::all();
       return view('pages.bidder.edit_bidder', compact('bidder', 'cities'));
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        if (isset($file)) {
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, true, true);
            $rows = 0;

            foreach ($data as $index => $row) {
                if ($index === 1 || empty($row['B'])) {
                    continue;
                }

                Bidder::create([
                    'category_id'   => $request->category_id ?? null,
                    'ma_dau_thau'   => $request->group ?? null,
                    'ma_phan'       => $row['A'] ?? null,
                    'ten_phan'      => $row['B'] ?? null,
                    'product_name'  => $row['C'] ?? null,
                    'quantity'      => $row['D'] ?? null,
                ]);

                $rows++;
            }
        } else {
            Bidder::create([
                'category_id'   => $request->category_id ?? null,
                'ma_dau_thau'   => $request->group ?? null,
                'ma_phan'       => $request->ma_phan ?? null,
                'ten_phan'      => $request->ten_phan ?? null,
                'product_name'  => $request->product_name ?? null,
                'quantity'      => $request->quantity ?? null,
            ]);
        }
        return redirect()->route('bidder.edit', ['id' => $request->group])->with('success', 'Thêm mới thành công');
    }

    public function getCategory($cityId)
    {
        $categories = CategoryBidder::where('city', $cityId)->get();

        return response()->json($categories);
    }

    public function getGroup($categoryId)
    {

        $groups = GroupBidder::where('category_id', $categoryId)->get();

        return response()->json($groups);
    }

    public function group()
    {
        $groups = GroupBidder::with('category')->orderBy('created_at', 'desc')->get();
        return view('pages.bidder.group_bidder', compact('groups'));
    }

    public function create_group(Request $request)
    {
        $cities = City::all();
        return view('pages.bidder.group_bidder_create', compact('cities'));
    }

    public function storeGroup(Request $request)
    {
        GroupBidder::create([
            'category_id'   => $request->category_id ?? null,
            'name'   => $request->name ?? null,
        ]);
        return redirect()->route('bidder.group')->with('success', 'Thêm mới thành công');
    }
}
