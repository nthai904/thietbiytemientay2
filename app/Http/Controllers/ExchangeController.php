<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\Document;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExchangeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'banle');

        if ($user->department !== "admin") {
            $query->where('user_id', $user->id);
        }

        $exchanges = $query->get();

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
                'user_name' => $firstItem->user->name ?? null,
                'bidder_name' => $firstItem->category->name ?? 'Không xác định',
            ];
        });

        $exchanges = $totals->values();
        $details = Document::all();
        $categories = CategoryBidder::all();
        return view('pages.exchange.index', compact('exchanges', 'details', 'user', 'categories'));
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
        $user = Auth::user();
        $file = $request->file('file');
        if (isset($file)) {
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, true, true);
            $rows = 0;
            foreach ($data as $index => $row) {
                if ($index < 2 || empty($row['B'])) {
                    continue;
                }
                $doc = Document::create([
                    'code_category_bidder' => $request->id_nhathau ?? null,
                    'product_name_bidder' => $row['B'],
                    'price'               => 0,
                    'total_price'         => 0,
                    'type'                => 'banle',
                    'status'              => 'bannhap'
                ]);
                $date_slug = Carbon::parse($doc->created_at)->format('HisdmY');
                $rows++;
            }
            return redirect()->route('exchange.detail', ['date' => $date_slug])->with('success', 'Thêm mới thành công!');
        } else {
            $productIds = $request->id_products;
            $product_name_bidder = $request->danh_muc_hang_hoa;
            $quy_cach = $request->quy_cach;
            $don_vi_tinh = $request->don_vi_tinh;
            $hang_sx = $request->hang_sx;
            $nuoc_sx = $request->nuoc_sx;
            $giaduthau = $request->exchange_price;
            $so_luong = $request->so_luong;
            $thanhtien = $request->thanhtien;
            $extra_price = $request->extra_price;
            $thong_so_ky_thuat_co_ban = $request->thong_so_ky_thuat_co_ban;
            if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
                return back()->withErrors(['message' => 'Thông tin sản phẩm hoặc giá trị không hợp lệ!']);
            }

            foreach ($productIds as $index => $id) {
                $product = Product::where('ky_ma_hieu', $id)->first();

                if ($product) {
                    Document::create([
                        'code_category_bidder'         => $request->id_nhathau,
                        'quantity'                     => $so_luong[$index] ?? 0,
                        'thong_so_ky_thuat_co_ban'     => $thong_so_ky_thuat_co_ban[$index] ?? null,
                        'product_name'                 => $product->name,
                        'product_name_bidder'          => $product_name_bidder[$index],
                        'quy_cach'                     => $quy_cach[$index],
                        'brand'                        => $hang_sx[$index],
                        'country'                      => $nuoc_sx[$index],
                        'price'                        => $giaduthau[$index] ?? 0,
                        'total_price'                  => $thanhtien[$index] ?? 0,
                        'id_product'                   => $product->ky_ma_hieu,
                        'extra_price'                  => $extra_price[$index] ?? 0,
                        'type'                         => 'banle',
                        'user_id'                      => $user->id,

                    ]);
                }
            }
            return redirect()->route('exchange.index')->with('success', 'Thêm mới thành công!');
        }
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
        $name = $documents->first()->category->name ?? 'Không xác định';
        $id_nhathau = $documents->first()->category->code ?? 'Không xác định';
        $cities = $documents->first()->category->city ?? 'Không xác định';
        $city = City::find($cities)->name;
        return view('pages.exchange.detail', compact('documents', 'products', 'name', 'city', 'date', 'id_nhathau'));
    }

    public function update(Request $request, $date)
    {
        $productIds =  $request->id_products;
        if (
            empty($productIds) ||
            (is_array($productIds) && count(array_filter($productIds, fn($id) => !is_null($id))) === 0)
        ) {
            $productIds = $request->id_product;
        }
        $giaduthau   = $request->exchange_price;
        $so_luong    = $request->so_luong;
        $thanhtien   = $request->thanhtien;
        $extra_price = $request->extra_price;
        $quy_cach = $request->quy_cach;
        $hang_sx = $request->hang_sx;
        $nuoc_sx = $request->nuoc_sx;
        $thong_so_ky_thuat_co_ban = $request->thong_so_ky_thuat_co_ban;
        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->withErrors(['message' => 'Thông tin sản phẩm hoặc giá trị không hợp lệ!']);
        }

        $createdAt = Carbon::createFromFormat('HisdmY', $date)->format('Y-m-d H:i:s');
        $oldDocuments = Document::where('created_at', $createdAt)->where('type', 'banle')->get();

        // Process each product ID
        foreach ($productIds as $index => $id) {
            $product = Product::where('ky_ma_hieu', $id)->first();

            if (!$product) continue;

            $data = [
                // 'unit'                         => $product->don_vi_tinh ?? null,
                'quantity'                     => $so_luong[$index] ?? 0,
                'thong_so_ky_thuat_co_ban'     => $thong_so_ky_thuat_co_ban[$index] ?? null,
                'product_name'                 => $product->name,
                'quy_cach'                     => $quy_cach[$index] ?? $product->quy_cach,
                'brand'                        => $hang_sx[$index] ?? $product->hang_sx,
                'country'                      => $nuoc_sx[$index] ?? $product->nuoc_sx,
                'price'                        => $giaduthau[$index] ?? 0,
                'total_price'                  => $thanhtien[$index] ?? 0,
                'id_product'                   => $product->ky_ma_hieu,
                'extra_price'                  => $extra_price[$index] ?? 0,
                'type'                         => 'banle',
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
            $path = isset($row['detail']) ? 'template/bg_ngoaithau.docx' : 'template/template.docx';
        }
        if ($documents->isEmpty()) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = public_path($path);
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
        $totalAll = 0;
        foreach ($documents as $index => $document) {
            $rowIndex = $index + 1;

            $templateProcessor->setValue("stt#{$rowIndex}", $rowIndex);
            $templateProcessor->setValue("product_name#{$rowIndex}", $document->product_name);
            $templateProcessor->setValue("product_name_bidder#{$rowIndex}", $document->product_name);
            $templateProcessor->setValue("detail#{$rowIndex}", $document->thong_so_ky_thuat_co_ban);
            $templateProcessor->setValue("country#{$rowIndex}", $document->country);
            $templateProcessor->setValue("quy_cach#{$rowIndex}", $document->product->quy_cach);
            $templateProcessor->setValue("unit#{$rowIndex}", $document->unit);
            $templateProcessor->setValue("quantity#{$rowIndex}", $document->quantity);
            $templateProcessor->setValue("price#{$rowIndex}", number_format($document->price));
            $templateProcessor->setValue("total_price#{$rowIndex}", number_format($document->total_price));

            $totalAll += $document->total_price;
        }
        $templateProcessor->setValue("total", number_format($totalAll));
        $filename = 'BảngBáoGiá_' . now()->format('Ymd_His') . '.docx';
        $savePath = storage_path("app/public/$filename");

        $templateProcessor->saveAs($savePath);

        return response()->download($savePath)->deleteFileAfterSend(true);
    }

    public function destroy($date)
    {
        try {
            $createdAt = Carbon::createFromFormat('HisdmY', $date)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Định dạng ngày không hợp lệ!');
        }

        $deleted = Document::where('created_at', $createdAt)
            ->where('type', 'banle')
            ->delete();

        if ($deleted === 0) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin bán lẻ phù hợp để xóa.');
        }

        return redirect()->back()->with('success', 'Xóa thông tin bán lẻ thành công.');
    }
}
