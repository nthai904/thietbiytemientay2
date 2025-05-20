<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\GroupBidder;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function getGroupByDate($date)
    {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);

        $data = GroupBidder::with('category', 'user')->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
        return response()->json($data);
    }
    public function group()
    {
        $user_role = Auth::user()->department;
        if ($user_role == 'admin') {
            $groups = GroupBidder::with('category')->orderBy('created_at', 'desc')->get();
        } else {
            $groups = GroupBidder::with('category')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        // $groups = GroupBidder::with('category')->orderBy('created_at', 'desc')->get();
        $categories = CategoryBidder::all();
        $cities = City::all();
        return view('pages.bidder.group_bidder', compact('groups', 'categories', 'cities'));
    }

    public function create_group(Request $request)
    {
        $cities = City::all();
        return view('pages.bidder.group_bidder_create', compact('cities'));
    }

    public function storeGroup(Request $request)
    {
        $user_id = Auth::user()->id;
        GroupBidder::create([
            'category_id'   => $request->category_id ?? null,
            'name'   => $request->name ?? null,
            'user_id'   => $user_id ?? null,
            'ngay_dong_thau'   => $request->ngay_dong_thau ?? null,
        ]);
        return redirect()->route('bidder.group')->with('success', 'Thêm mới thành công');
    }

    public function edit_group($id)
    {
        $user_id = Auth::user()->id;
        Notification::where('group_id', $id)
            ->where('user_id', $user_id)
            ->where('status', 'new')
            ->update(['status' => 'seen']);
        $group = GroupBidder::with('category')->where('id', $id)->first();
        $cities = City::where('id', $group->category->city)->first();
        return view('pages.bidder.group_bidder_edit', compact('group', 'cities'));
    }

    public function update_group(Request $request, $id)
    {
        GroupBidder::where('id', $id)->update([
            'name'   => $request->name ?? null,
            'ngay_dong_thau'   => $request->ngay_dong_thau ?? null,
        ]);
        return redirect()->route('bidder.group')->with('success', 'Cập nhật thành công');
    }

    public function destroy_group($id)
    {
        $group_bidder = GroupBidder::where('id', $id)->first();

        if ($group_bidder) {
            $group_bidder->delete();
            return redirect()->route('bidder.group')->with('success', 'Xóa gói thầu thành công');
        }
    }
}
