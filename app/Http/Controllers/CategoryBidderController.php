<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\GroupBidder;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    public function edit($code)
    {
        $category = CategoryBidder::with('city')->where('code', $code)->first();
        $cities = City::all();
        return view('pages.bidder.edit_category', compact('cities', 'category'));
    }

    public function update(Request $request, $code)
    {
        $categoryBidder = CategoryBidder::where('code', $code)->first();

        if (!$categoryBidder) {
            return redirect()->back()->with('error', 'Không tìm thấy bản ghi cần cập nhật.');
        }

        $categoryBidder->update([
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

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function destroy($id)
    {
        $category_bidder = CategoryBidder::where('id', $id)->first();

        if ($category_bidder) {
            $category_bidder->delete();
            return redirect()->back()->with('success', 'Xóa bệnh viện thành công');
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);
        $rows = 0;

        foreach ($data as $index => $row) {
            if ($index < 3 || empty($row['A'])) {
                continue;
            }
            $city = City::where('name', $row['G'])->first();
            CategoryBidder::create([
                'code'          => $row['A'] ?? null,
                'name'          => $row['B'] ?? null,
                'address'       => $row['C'] ?? null,
                'tax_code'      => $row['E'] ?? null,
                'phone'         => $row['F'] ?? null,
                'city'          => $city->id ?? null
            ]);

            $rows++;
        }


        return redirect()->back()->with('success', 'Thêm mới thành công');
    }
}
