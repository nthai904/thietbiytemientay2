<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            if ($index === 1 || empty($row['B'])) {
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
                'code' => $row['C'] ?? '',
                'tag' => $row['D'] ?? '',
                'year' => $row['E'] ?? '',
                'country' => $row['F'] ?? '',
                'price' => $price,
                'brand' => $row['H'] ?? '',
                'unit' => $row['I'] ?? '',
                'quy_cach' => $row['J'] ?? '',
                'category' => $row['K'] ?? '',
            ]);
            $rows++;
        }

        return redirect()->back();
    }


    public function detail($id)
    {
        $product = Product::where('code', $id)->first();
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
}
