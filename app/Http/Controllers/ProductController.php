<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.product.danhmuchanghoa', compact('products'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);

        $rows = 0;

        foreach ($data as $index => $row) {
            if ($index < 7 || empty($row['B'])) {
                continue;
            }

            $price = $row['G'] ?? '';
            $price = str_replace(['đ', ','], '', $price);

            if (is_numeric($price)) {
                $price = (float)$price;
            } else {
                $price = 0;
            }
            Product::create([
                'name' => $row['B'] ?? '',
                'ky_ma_hieu' => $row['C'] ?? '',
                'nhan_hieu' => '',
                'thong_so_ky_thuat_co_ban' => $row['D'] ?? '',
                'thong_so_ky_thuat_thau' => $row['E'] ?? '',
                'hang_sx' => $row['F'] ?? '',
                'nuoc_sx' => $row['G'] ?? '',
                'hang_nuoc_chu_so_huu' => $row['H'] ?? '',
                'quy_cach' => $row['I'] ?? '',
                'don_vi_tinh' => $row['J'] ?? '',
                'hsd' => isset($row['K']) && $row['K']
                    ? Carbon::createFromFormat('m/d/Y', $row['K'])->format('Y-m-d')
                    : null,
                'gia_von' => $row['L'] ?? 0,
                'gia_de_xuat' => $row['M'] ?? 0,
                'ten_ncc' => $row['N'] ?? '',
                'ma_vtyt' => $row['O'] ?? '',
                'nhom_theo_tt' => $row['P'] ?? '',
                'phan_loai_ttbyt' => $row['Q'] ?? '',
                'so_dang_ky_luu_hanh' => $row['R'] ?? '',
                'so_bang_phan_loai' => $row['S'] ?? '',
                'ghi_chu' => $row['T'] ?? '',
            ]);

            $rows++;
        }

        return redirect()->back();
    }


    public function detail($id)
    {
        $product = Product::where('ky_ma_hieu', $id)->first();
        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy'
        ]);
    }

    public function create()
    {
        return view('pages.product.create');
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
    }

    public function edit($id)
    {
        $product = Product::where('ky_ma_hieu', $id)->first();
        return view('pages.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('ky_ma_hieu', $id)->first();
        if ($product) {
            $product->update($request->all());
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
        }
    }

    public function destroy($id)
    {
        $product = Product::where('ky_ma_hieu', $id)->first();

        if ($product) {
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công');
        }
    }
}
