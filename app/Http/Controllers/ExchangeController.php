<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\Document;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

class ExchangeController extends Controller
{
    public function index()
    {

        $exchanges = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'banle')
            ->get();

        $totals = $exchanges->groupBy('created_at')->map(function ($group) {
            $firstItem = $group->first();
            $createdAt = Carbon::parse($firstItem->created_at)->format('H:i d/m/Y ');
            $date_slug = Carbon::parse($firstItem->created_at)->format('HisdmY');
            return [
                'id' => $firstItem->id,
                'code_category_bidder' => $firstItem->code_category_bidder,
                'id_product' => $firstItem->id_product,
                'created_at' => $createdAt,
                'date_slug' => $date_slug,
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

        return redirect()->route('exchange.index')->with('success', 'Thêm mới thành công!');
    }

    public function detail($date)
    {
        $hour = substr($date, 0, 2);
        $minute = substr($date, 2, 2);
        $second = substr($date, 4, 2);
        $day = substr($date, 6, 2);
        $month = substr($date, 8, 2);
        $year = substr($date, 10, 4);

        try {
            $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', "$year-$month-$day $hour:$minute:$second");
        } catch (\Exception $e) {
            return back()->with('error', 'Định dạng ngày không hợp lệ: ' . $e->getMessage());
        }

        $products = Product::all();

        $documents = Document::whereDate('created_at', $formattedDate->toDateString())
            ->whereTime('created_at', $formattedDate->format('H:i:s'))
            ->where('type', 'banle')
            ->with(['bidder', 'product'])
            ->get();
        $name = $documents->first()->bidder->category->name ?? 'Không xác định';
        $id_nhathau = $documents->first()->bidder->category->code ?? 'Không xác định';
        $cities = $documents->first()->bidder->category->city ?? 'Không xác định';
        $city = City::find($cities)->name;
        return view('pages.exchange.detail', compact('documents', 'products', 'name', 'city', 'date', 'id_nhathau'));
    }

    public function update(Request $request, $date)
    {
        $productIds  = $request->id_products;
        $giaduthau   = $request->exchange_price;
        $so_luong    = $request->so_luong;
        $thanhtien   = $request->thanhtien;
        $extra_price = $request->extra_price;

        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->withErrors(['message' => 'Thông tin sản phẩm hoặc giá trị không hợp lệ!']);
        }

        $createdAt = Carbon::createFromFormat('HisdmY', $date)->format('Y-m-d H:i:s');
        $oldDocuments = Document::where('created_at', $createdAt)->where('type', 'banle')->get();

        // Process each product ID
        foreach ($productIds as $index => $id) {
            $product = Product::where('code', $id)->first();

            if (!$product) continue;

            $data = [
                'unit'         => $product->unit,
                'quantity'     => $so_luong[$index] ?? 0,
                'product_name' => $product->name,
                'quy_cach'     => $product->quy_cach,
                'brand'        => $product->brand,
                'country'      => $product->country,
                'price'        => $giaduthau[$index] ?? 0,
                'total_price'  => $thanhtien[$index] ?? 0,
                'id_product'   => $product->code,
                'extra_price'  => $extra_price[$index] ?? 0,
                'type'         => 'banle',
            ];

            // Update existing document or create new one
            if ($index < $oldDocuments->count()) {
                $oldDocuments[$index]->update($data);
            } else {
                Document::create(array_merge($data, [
                    'code_category_bidder' => $request->id_nhathau,
                    'created_at'           => $createdAt,
                ]));
            }
        }

        if ($oldDocuments->count() > count($productIds)) {
            for ($i = count($productIds); $i < $oldDocuments->count(); $i++) {
                $oldDocuments[$i]->delete();
            }
        }

        return redirect()->route('exchange.index')->with('success', 'Cập nhật thành công!');
    }

    public function exportWord(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);
        foreach ($selectedRows as $row) {
            $createdAt = Carbon::createFromFormat('HisdmY', $row['date'])->format('Y-m-d H:i:s');
            $documents = Document::where('code_category_bidder', $row['id'])
                ->where('type', 'banle')
                ->where('created_at', $createdAt)
                ->get();
        }
        if ($documents->isEmpty()) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = public_path('template/template.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('day', now()->format('d'));
        $templateProcessor->setValue('month', now()->format('m'));
        $templateProcessor->setValue('year', now()->format('Y'));

        if (count($documents) > 0) {
            $hospitalName = $documents[0]->bidder->category->name;
            $templateProcessor->setValue('receiver', $hospitalName);
        } else {
            $templateProcessor->setValue('receiver', 'Không xác định');
        }

        $templateProcessor->cloneRow('stt', count($documents));

        foreach ($documents as $index => $document) {
            $rowIndex = $index + 1;

            $templateProcessor->setValue("stt#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("product_name#{$rowIndex}", $document->product_name);
            $templateProcessor->setValue("product_name_bidder#{$rowIndex}", $document->product_name);
            $templateProcessor->setValue("detail#{$rowIndex}", $document->product->detail);
            $templateProcessor->setValue("country#{$rowIndex}", $document->product->country);
            $templateProcessor->setValue("quy_cach#{$rowIndex}", $document->product->quy_cach);
            $templateProcessor->setValue("unit#{$rowIndex}", $document->unit);
            $templateProcessor->setValue("quantity#{$rowIndex}", $document->quantity);
            $templateProcessor->setValue("price#{$rowIndex}", number_format($document->price));
            $templateProcessor->setValue("total_price#{$rowIndex}", number_format($document->total_price));
        }

        $filename = 'BảngBáoGiá_' . now()->format('Ymd_His') . '.docx';
        $savePath = storage_path("app/public/$filename");

        $templateProcessor->saveAs($savePath);

        return response()->download($savePath)->deleteFileAfterSend(true);
    }
}
