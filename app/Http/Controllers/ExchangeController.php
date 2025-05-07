<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\Document;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExchangeController extends Controller
{
    public function index()
    {
        
        $exchanges = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'banle')
            ->get();

        $totals = $exchanges->groupBy('code_category_bidder')->map(function ($group) {
            $firstItem = $group->first();
            $createdAt = Carbon::parse($firstItem->created_at)->format('H:i d/m/Y ');

            return [
                'code_category_bidder' => $firstItem->code_category_bidder,
                'id_product' => $firstItem->id_product,
                'created_at' => $createdAt,
                'total_price' => $group->sum('total_price'),
                'bidder_name' => $firstItem->bidder->category->name ?? 'Không xác định',
            ];
        });

        $exchanges = $totals->values(); 
        $details = Document::all();

        return view('pages.exchange.index', compact('exchanges', 'details'));
    }


    public function create()
    {
        $categories = CategoryBidder::all();
        $products = Product::all();
        $cities = City::all();
        return view('pages.exchange.create', compact('categories', 'products', 'cities'));
    }

    public function store(Request $request)
    {
        // $bidders = Bidder::where('category_id', $request->id_nhathau)->get()->values();

        $productIds = $request->id_products;
        $giaduthau = $request->exchange_price;
        $so_luong = $request->so_luong;
        $thanhtien = $request->thanhtien;
        $extra_price = $request->extra_price;

        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->withErrors(['message' => 'Thông tin sản phẩm hoặc giá trị không hợp lệ!']);
        }

        foreach ($productIds as $index => $id) {
            $product = Product::where('code', $id)->first();

            if ($product) {
                Document::create([
                    'code_category_bidder' => $request->id_nhathau,
                    'unit'                 => $product->unit,
                    'quantity'             => $so_luong[$index] ?? 0,
                    'product_name'         => $product->name,
                    'quy_cach'             => $product->quy_cach,
                    'brand'                => $product->brand,
                    'country'              => $product->country,
                    'price'                => $giaduthau[$index] ?? 0,
                    'total_price'          => $thanhtien[$index] ?? 0,
                    'id_product'           => $product->code,
                    'extra_price'          => $extra_price[$index] ?? 0,
                    'type'                 => 'banle',
                ]);
            }
        }

        return redirect()->route('exchange.index')->with('success', 'Tạo document thành công!');
    }
}
