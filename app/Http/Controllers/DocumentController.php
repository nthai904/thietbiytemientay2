<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\Document;
use App\Models\DocumentLog;
use App\Models\GroupBidder;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\RichText\Run;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $documents = Document::with(['bidder.category', 'group'])
            ->where('type', 'dauthau')
            ->when(!$user->is_admin, function ($query) use ($user) {
                $query->whereHas('group', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $totals = $documents->groupBy('group_id')->map(function ($group) {
            return [
                'code_category_bidder' => $group->first()->code_category_bidder,
                'id_product' => $group->first()->id_product,
                'total_price' => $group->sum('total_price'),
                'bidder_name' => $group->first()->bidder->category->name ?? 'Không xác định',
                'group' => $group->first()->group->name ?? 'Không xác định',
                'group_id' => $group->first()->group->id ?? 'Không xác định',
                'status' => $group->first()->status
            ];
        });

        $documents = $totals->values();

        $details = Document::all(); 

        return view('pages.document.index', compact('documents', 'details'));
    }


    public function create()
    {
        $categories = CategoryBidder::all();
        $products = Product::all();
        $cities = City::all();
        return view('pages.document.create', compact('categories', 'products', 'cities'));
    }

    public function store(Request $request)
    {
        $bidders = Bidder::where('category_id', $request->id_nhathau)->get()->values();

        if ($bidders->isEmpty()) {
            return back()->with(['error' => 'Không tìm thấy bệnh viện!']);
        }

        $productIds = $request->id_product;
        $giaduthau = $request->giaduthau;
        $thanhtien = $request->thanhtien;
        $extra_price = $request->extra_price;
        $don_vi_tinh = $request->don_vi_tinh;
        $quy_cach = $request->quy_cach;
        $hang_sx = $request->hang_sx;
        $nuoc_sx = $request->nuoc_sx;
        $thong_so_ky_thuat_co_ban = $request->thong_so_ky_thuat_co_ban;
        $thong_so_ky_thuat_thau = $request->thong_so_ky_thuat_thau;
        $hang_nuoc_chu_so_huu = $request->hang_nuoc_chu_so_huu;
        $hsd = $request->hsd;
        $ten_ncc = $request->ten_ncc;
        $ma_vtyt = $request->ma_vtyt;
        $nhom_theo_tt = $request->nhom_theo_tt;
        $phan_loai_ttbyt = $request->phan_loai_ttbyt;
        $so_dang_ky_luu_hanh = $request->so_dang_ky_luu_hanh;
        $so_bang_phan_loai = $request->so_bang_phan_loai;
        $ghi_chu = $request->ghi_chu;

        $group = $request->group;
        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->with(['error' => 'Thông tin sản phẩm không hợp lệ!']);
        }

        foreach ($productIds as $index => $id) {
            $product = Product::where('ky_ma_hieu', $id)->first();
            $bidder = $bidders->get($index);

            if ($product && $bidder) {
                Document::create([
                    'ma_phan'                  => $bidder->ma_phan,
                    'ten_phan'                 => $bidder->ten_phan,
                    'code_category_bidder'     => $request->id_nhathau,
                    'unit'                     => $don_vi_tinh[$index],
                    'quantity'                 => $bidder->quantity,
                    'product_name'             => $product->name,
                    'quy_cach'                 => $quy_cach[$index],
                    'brand'                    => $hang_sx[$index],
                    'country'                  => $nuoc_sx[$index],
                    'thong_so_ky_thuat_co_ban' => $thong_so_ky_thuat_co_ban[$index],
                    'thong_so_ky_thuat_thau'   => $thong_so_ky_thuat_thau[$index],
                    'hang_nuoc_chu_so_huu'     => $hang_nuoc_chu_so_huu[$index],
                    'hsd'                      => $hsd[$index],
                    'ten_ncc'                  => $ten_ncc[$index],
                    'ma_vtyt'                  => $ma_vtyt[$index],
                    'nhom_theo_tt'             => $nhom_theo_tt[$index],
                    'phan_loai_ttbyt'          => $phan_loai_ttbyt[$index],
                    'so_dang_ky_luu_hanh'      => $so_dang_ky_luu_hanh[$index],
                    'so_bang_phan_loai'        => $so_bang_phan_loai[$index],
                    'ghi_chu'                  => $ghi_chu[$index],
                    'price'                    => $giaduthau[$index] ?? 0,
                    'total_price'              => $thanhtien[$index] ?? 0,
                    'id_product'               => $product->ky_ma_hieu,
                    'extra_price'              => $extra_price[$index] ?? 0,
                    'product_name_bidder'      => $bidder->product_name,
                    'type'                     => 'dauthau',
                    'group_id'                 => $group,
                ]);
                GroupBidder::where('id', $group)->update([
                    'bided' => true
                ]);
            }
        }

        return redirect()->route('document.index')->with('success', 'Thêm mới thành công');
    }
    public function storeBanNhap(Request $request)
    {
        $code_category_bidder = $request->id_nhathau;
        $group = $request->group;
        $bidders = Bidder::where('category_id', $request->id_nhathau)->where('ma_dau_thau', $request->group)->get()->values();
        foreach ($bidders as $bidder) {
            Document::create(
                [
                    'ma_phan'                  => $bidder->ma_phan,
                    'ten_phan'                 => $bidder->ten_phan,
                    'code_category_bidder'     => $code_category_bidder,
                    'quantity'                 => $bidder->quantity,
                    'product_name_bidder'      => $bidder->product_name,
                    'type'                     => 'dauthau',
                    'group_id'                 => $group,
                    'status'                   => 'bannhap'
                ]
            );
        }
        return redirect()->route('document.edit', ['code' => $code_category_bidder, 'group' => $group])->with('success', 'Thêm mới thành công');
    }
    public function edit($code, $group)
    {
        $categories = CategoryBidder::all();
        $products = Product::all();

        $documents = Document::with(['bidder', 'product'])
            ->where('code_category_bidder', $code)
            ->where('group_id', $group)
            ->where('type', 'dauthau')
            ->get();
        // dd($documents);
        $total_orginal = $documents->sum(function ($doc) {
            return ($doc->product->gia_von ?? 0) * ($doc->quantity ?? 0);
        });
        // dd($total_orginal);
        $totalAmount = $documents->sum('total_price');

        $totalDocuments = $documents->count();
        $trungDocuments = $documents->where('status', 'datrung')->count();

        $rate = $trungDocuments . '/' . $totalDocuments;
        $percent = $totalDocuments > 0 ? round($trungDocuments / $totalDocuments * 100, 2) : 0;

        $totalTrung = $documents->where('status', 'datrung')->sum('total_price');

        return view('pages.document.edit', compact('categories', 'products', 'documents', 'total_orginal', 'totalAmount', 'rate', 'percent', 'totalTrung'));
    }

    public function update(Request $request, $code, $group)
    {

        $productIds = $request->id_product;
        $giaduthau = $request->giaduthau;
        $thanhtien = $request->thanhtien;
        $extra_price = $request->extra_price;
        $don_vi_tinh = $request->unit;
        $quy_cach = $request->quy_cach;
        $hang_sx = $request->hang_sx;
        $nuoc_sx = $request->nuoc_sx;
        // $thong_so_ky_thuat_co_ban = $request->thong_so_ky_thuat_co_ban;
        // $thong_so_ky_thuat_thau = $request->thong_so_ky_thuat_thau;
        // $hang_nuoc_chu_so_huu = $request->hang_nuoc_chu_so_huu;
        // $hsd = $request->hsd;
        // $ten_ncc = $request->ten_ncc;
        // $ma_vtyt = $request->ma_vtyt;
        // $nhom_theo_tt = $request->nhom_theo_tt;
        // $phan_loai_ttbyt = $request->phan_loai_ttbyt;
        // $so_dang_ky_luu_hanh = $request->so_dang_ky_luu_hanh;
        // $so_bang_phan_loai = $request->so_bang_phan_loai;
        // $ghi_chu = $request->ghi_chu;
        $status    = $request->status;

        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->withErrors(['message' => 'Thiếu thông tin cập nhật!']);
        }

        $documents = Document::where('code_category_bidder', $code)->where('group_id', $group)->get();
        foreach ($documents as $index => $doc) {

            $product = Product::where('ky_ma_hieu', $productIds[$index])->first();
            if ($product) {
                $doc->update([
                    'id_product'    => $product->ky_ma_hieu,
                    'product_name'  => $product->name,
                    'unit'          => $don_vi_tinh[$index],
                    'quy_cach'      => $quy_cach[$index],
                    'brand'         => $hang_sx[$index],
                    'country'       => $nuoc_sx[$index],
                    'price'         => $giaduthau[$index],
                    'total_price'   => $thanhtien[$index],
                    'extra_price'   => $extra_price[$index],
                    'status'        => $status[$index],
                ]);
            }
        }


        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function exportExcel(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);
        foreach ($selectedRows as $row) {
            $documents = Document::where('code_category_bidder', $row['id'])->where('group_id', $row['group'])->where('type', 'dauthau')->get();
        }
        if ($documents->isEmpty()) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = public_path('template/template.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $startRow = 6;
        $rowIndex = $startRow;
        $counter = 1;

        foreach ($documents as $document) {
            $sheet->setCellValue("A{$rowIndex}", $counter++);
            $sheet->setCellValue("B{$rowIndex}", $document->ma_phan);
            $sheet->setCellValue("C{$rowIndex}", $document->ten_phan);
            $sheet->setCellValue("D{$rowIndex}", $document->product_name_bidder);
            $sheet->setCellValue("E{$rowIndex}", $document->product->name);
            $sheet->setCellValue("F{$rowIndex}", $document->id_product);
            $sheet->setCellValue("G{$rowIndex}", '');
            $sheet->setCellValue("H{$rowIndex}", $document->id_product);
            $sheet->setCellValue("I{$rowIndex}", $document->product->tag);
            $sheet->setCellValue("J{$rowIndex}", $document->product->year);
            $sheet->setCellValue("K{$rowIndex}", $document->country);
            $sheet->setCellValue("L{$rowIndex}", $document->brand);
            $sheet->setCellValue("M{$rowIndex}", $document->thong_so_ky_thuat_thau);
            $sheet->setCellValue("N{$rowIndex}", $document->unit);
            $sheet->setCellValue("O{$rowIndex}", $document->quantity);
            $sheet->setCellValue("P{$rowIndex}", '');
            $sheet->setCellValue("Q{$rowIndex}", $document->product->category);


            $sheet->getStyle("A{$rowIndex}:Q{$rowIndex}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $sheet->getStyle("A{$rowIndex}:Q{$rowIndex}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $rowIndex++;
        }
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $filename = 'DanhSachNhaThau_' . now()->format('Ymd_His') . '.xlsx';
        $savePath = storage_path("app/public/$filename");

        $writer = new Xlsx($spreadsheet);
        $writer->save($savePath);

        return response()->download($savePath)->deleteFileAfterSend(true);
    }

    public function exportWord(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);
        foreach ($selectedRows as $row) {
            $documents = Document::where('code_category_bidder', $row['id'])->where('group_id', $row['group'])->where('type', 'dauthau')->get();
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
            $templateProcessor->setValue("product_name#{$rowIndex}", $document->product_name_bidder);
            $templateProcessor->setValue("product_name_bidder#{$rowIndex}", $document->product_name);
            $templateProcessor->setValue("detail#{$rowIndex}", $document->thong_so_ky_thuat_thau);
            $templateProcessor->setValue("country#{$rowIndex}", $document->country);
            $templateProcessor->setValue("quy_cach#{$rowIndex}", $document->quy_cach);
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

    public function exportContract(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);

        foreach ($selectedRows as $row) {
            $documents = Document::where('code_category_bidder', $row['id'])->where('group_id', $row['group'])->where('type', 'dauthau')->get();
        }

        if ($documents->isEmpty()) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        // Nhóm theo code_category_bidder
        $grouped = $documents->groupBy('code_category_bidder');

        // Lấy nhóm đầu tiên (1 đơn vị thầu)
        $firstGroup = $grouped->first();

        if (!$firstGroup || !$firstGroup->first()) {
            return back()->with('error', 'Không tìm thấy dữ liệu hợp lệ để xuất.');
        }

        $firstDoc = $firstGroup->first(); // lấy 1 dòng để dùng thông tin chung
        $total_price = $firstGroup->sum('total_price');
        $bao_lanh = $total_price * 0.03;

        // Tạo template
        $templatePath = public_path('template/hopdong.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        // Gán dữ liệu vào file Word
        $templateProcessor->setValue('day', now()->format('d'));
        $templateProcessor->setValue('month', now()->format('m'));
        $templateProcessor->setValue('year', now()->format('Y'));
        $templateProcessor->setValue('id', $firstDoc->id);
        $templateProcessor->setValue('name', $firstDoc->bidder->category->name ?? 'Không xác định');
        $templateProcessor->setValue('total_category', $firstGroup->count());

        // Thông tin nhà thầu
        $templateProcessor->setValue("address", $firstDoc->bidder->category->address ?? '');
        $templateProcessor->setValue("phone", $firstDoc->bidder->category->phone ?? '');
        $templateProcessor->setValue("fax", $firstDoc->bidder->category->fax ?? '');
        $templateProcessor->setValue("tk", $firstDoc->bidder->category->tk ?? '');
        $templateProcessor->setValue("tax_code", $firstDoc->bidder->category->tax_code ?? '');
        $templateProcessor->setValue("represent", $firstDoc->bidder->category->represent ?? '');
        $templateProcessor->setValue("position", $firstDoc->bidder->category->position ?? '');
        $templateProcessor->setValue("gender", ($firstDoc->bidder->category->gender == 'male') ? 'Ông' : 'Bà');
        $templateProcessor->setValue("position_uppercase", mb_strtoupper($firstDoc->bidder->category->position ?? '', 'UTF-8'));

        // Tổng tiền & bảo lãnh
        $templateProcessor->setValue("price", number_format($total_price));
        $templateProcessor->setValue("price_text", $this->convertNumberToWords($total_price));
        $templateProcessor->setValue("bao_lanh", number_format($bao_lanh));
        $templateProcessor->setValue("bao_lanh_text", $this->convertNumberToWords($bao_lanh));

        // Lưu file và trả về
        $filename = 'HopDong_' . now()->format('Ymd_His') . '.docx';
        $savePath = storage_path("app/public/$filename");

        $templateProcessor->saveAs($savePath);

        return response()->download($savePath)->deleteFileAfterSend(true);
    }

    public function exportContractPhuluc(Request $request)
    {

        $selectedRows = json_decode($request->selectedRows, true);
        $documents = Document::select([
            'ma_phan',
            'ten_phan',
            'id_product',
            'country',
            'brand',
            'thong_so_ky_thuat_co_ban',
            'unit',
            'quantity',
            'price',
            'total_price',
            'code_category_bidder'
        ])
            ->where('code_category_bidder', $selectedRows[0]['id'])
            ->where('group_id', $selectedRows[0]['group'])
            ->where('type', 'dauthau')
            ->get()
            ->toArray();
        $position = CategoryBidder::where('code', $documents[0]['code_category_bidder'])->first();

        if (empty($documents)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = public_path('template/mau_phuluc2.xlsx');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();
        $count = count($documents);

        $sheet->setCellValue('A2', "Gói thầu: Mua sắm thiết bị y tế thông dụng ({$count} danh mục)");
        $sheet->mergeCells('A2:L2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);

        $startRow = 7;
        $sheet->getRowDimension($startRow)->setRowHeight(-1);
        $rowCount = count($documents);

        $data = [];
        foreach ($documents as $index => $document) {
            $data[] = [
                $index + 1,
                $document['ma_phan'],
                $document['ten_phan'],
                $document['id_product'],
                $document['country'],
                $document['brand'],
                $document['thong_so_ky_thuat_co_ban'],
                '',
                $document['unit'],
                $document['quantity'],
                number_format($document['price']),
                number_format($document['total_price']),
            ];
        }

        $sheet->fromArray($data, null, "A{$startRow}", true);

        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setWidth(15);
        }

        $endRow = $startRow + $rowCount - 1;
        $styleRange = "A{$startRow}:L{$endRow}";
        $sheet->getStyle($styleRange)->getAlignment()->setWrapText(true);
        $sheet->getStyle($styleRange)->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 12,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $summaryRow = $endRow + 1;
        $totalAmount = array_sum(array_column($documents, 'total_price'));

        $sheet->setCellValue("A{$summaryRow}", 'Tổng cộng');
        $sheet->mergeCells("A{$summaryRow}:K{$summaryRow}");
        $sheet->setCellValue("L{$summaryRow}", number_format($totalAmount));

        $sheet->getStyle("A{$summaryRow}:L{$summaryRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $extraRow = $summaryRow + 1;

        $sheet->mergeCells("A{$extraRow}:D{$extraRow}");
        $sheet->mergeCells("E{$extraRow}:L{$extraRow}");
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->setCellValue("A{$extraRow}", "Tổng số mặt hàng: {$count}");
        $sheet->setCellValue("E{$extraRow}", "Tổng giá trị: " . number_format($totalAmount) . " đồng (Viết bằng chữ: " . $this->convertNumberToWords($totalAmount) . ").");


        $sheet->getStyle("A{$extraRow}:L{$extraRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13, // Cỡ chữ 12
                'bold' => true, // Đảm bảo in đậm
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        // Thêm dòng cho "ĐẠI DIỆN BÊN B" và "ĐẠI DIỆN BÊN A"
        $newRow = $extraRow + 2;

        // Merge cột C và D, điền "ĐẠI DIỆN BÊN B"
        $sheet->mergeCells("C{$newRow}:D{$newRow}");
        $sheet->setCellValue("C{$newRow}", "ĐẠI DIỆN BÊN B");
        $sheet->getStyle("C{$newRow}:D{$newRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        // Merge cột G đến L, điền "ĐẠI DIỆN BÊN A"
        $sheet->mergeCells("G{$newRow}:L{$newRow}");
        $sheet->setCellValue("G{$newRow}", "ĐẠI DIỆN BÊN A");
        $sheet->getStyle("G{$newRow}:L{$newRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);


        $finalRow = $newRow + 1;

        // Merge cột C và D cho "Giám đốc"
        $sheet->mergeCells("C{$finalRow}:D{$finalRow}");
        $sheet->setCellValue("C{$finalRow}", "Giám đốc");

        // Merge cột G đến L cho "Phó giám đốc"
        $sheet->mergeCells("G{$finalRow}:L{$finalRow}");
        $sheet->setCellValue("G{$finalRow}", $position['position']);

        $sheet->getStyle("C{$finalRow}:D{$finalRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $sheet->getStyle("G{$finalRow}:L{$finalRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        $theendRow = $finalRow + 6;

        // Merge cột C và D cho "Giám đốc"
        $sheet->mergeCells("C{$theendRow}:D{$theendRow}");
        $sheet->setCellValue("C{$theendRow}", "LÊ THỊ MỸ NGA");

        // Merge cột G đến L cho "Phó giám đốc"
        $sheet->mergeCells("G{$theendRow}:L{$theendRow}");
        $sheet->setCellValue("G{$theendRow}", $position['represent']);

        $sheet->getStyle("C{$theendRow}:D{$theendRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $sheet->getStyle("G{$theendRow}:L{$theendRow}")->applyFromArray([
            'font' => [
                'name' => 'Times New Roman',
                'size' => 13,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $hospitalName = $position['name'] ?? 'Bệnh Viện';
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        return response($excelOutput)
            ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->header('Content-Disposition', 'attachment; filename="DanhSachTrungThau_' . $hospitalName . '.xlsx"')
            ->header('Cache-Control', 'max-age=0');
    }

    public function exportBaoGiaKH(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);
        $templatePath = public_path('template/bg_kehoach.xlsx');

        $documents = Document::select([
            'ma_phan',
            'ten_phan',
            'id_product',
            'country',
            'brand',
            'thong_so_ky_thuat_co_ban',
            'unit',
            'quantity',
            'price',
            'total_price',
            'code_category_bidder',
            'quy_cach'
        ])
            ->where('code_category_bidder', $selectedRows[0]['id'])
            ->where('group_id', $selectedRows[0]['group'])
            ->where('type', 'dauthau')
            ->get();

        $position = CategoryBidder::where('code', $selectedRows[0]['id'])->first();
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B7', str_replace('{{category}}', $position->name, $sheet->getCell('B7')->getValue()));
        $sheet->setCellValue('C8', str_replace('{{category}}', $position->name, $sheet->getCell('C8')->getValue()));

        $today = now();

        $dataCount = count($documents);
        $startRow = 13;
        $originalFooterRow = 15;
        $endDataRow = $startRow + $dataCount - 1;

        // Lưu style của footer trước khi chèn dòng mới
        $footerStyles = [];
        if ($endDataRow >= $originalFooterRow) {
            // Lưu style của các dòng footer
            for ($footerRow = $originalFooterRow; $footerRow <= $originalFooterRow + 5; $footerRow++) {
                for ($col = 'A'; $col <= 'P'; $col++) {
                    $footerStyles[$footerRow][$col] = $sheet->getStyle("{$col}{$footerRow}")->exportArray();
                }
                // Lưu row height
                $footerStyles[$footerRow]['row_height'] = $sheet->getRowDimension($footerRow)->getRowHeight();
            }

            // Lưu merged cells của footer
            $footerMergedCells = [];
            foreach ($sheet->getMergeCells() as $mergedCell) {
                if (preg_match("/([A-Z]+)(\d+):([A-Z]+)(\d+)/", $mergedCell, $matches)) {
                    $startCol = $matches[1];
                    $startRowNum = (int)$matches[2];
                    $endCol = $matches[3];
                    $endRowNum = (int)$matches[4];

                    if ($startRowNum >= $originalFooterRow && $endRowNum <= $originalFooterRow + 5) {
                        $footerMergedCells[] = [
                            'range' => $mergedCell,
                            'start_col' => $startCol,
                            'start_row' => $startRowNum,
                            'end_col' => $endCol,
                            'end_row' => $endRowNum
                        ];
                    }
                }
            }

            $rowsToInsert = $endDataRow - $originalFooterRow + 1;
            $sheet->insertNewRowBefore($originalFooterRow, $rowsToInsert);
            $newFooterRow = $originalFooterRow + $rowsToInsert;

            // Áp dụng lại style cho footer sau khi chèn dòng
            foreach ($footerStyles as $originalRow => $rowStyles) {
                $newRow = $originalRow + $rowsToInsert;

                // Áp dụng style cho từng cell
                foreach ($rowStyles as $col => $style) {
                    if ($col !== 'row_height') {
                        $sheet->getStyle("{$col}{$newRow}")->applyFromArray($style);
                    }
                }

                // Áp dụng row height
                if (isset($rowStyles['row_height'])) {
                    $sheet->getRowDimension($newRow)->setRowHeight($rowStyles['row_height']);
                }
            }

            // Áp dụng lại merged cells cho footer
            foreach ($footerMergedCells as $mergedCell) {
                $newStartRow = $mergedCell['start_row'] + $rowsToInsert;
                $newEndRow = $mergedCell['end_row'] + $rowsToInsert;
                $newRange = "{$mergedCell['start_col']}{$newStartRow}:{$mergedCell['end_col']}{$newEndRow}";
                $sheet->mergeCells($newRange);
            }
        } else {
            $newFooterRow = $originalFooterRow;
        }

        foreach ($documents as $index => $doc) {
            $row = $startRow + $index;

            if ($index > 0) {
                for ($col = 'A'; $col <= 'P'; $col++) {
                    $sheet->duplicateStyle(
                        $sheet->getStyle("{$col}{$startRow}"),
                        "{$col}{$row}"
                    );
                }

                $sheet->getRowDimension($row)->setRowHeight(
                    $sheet->getRowDimension($startRow)->getRowHeight()
                );

                foreach ($sheet->getMergeCells() as $mergedCell) {
                    if (preg_match("/([A-Z]+){$startRow}:([A-Z]+){$startRow}/", $mergedCell, $matches)) {
                        $startCol = $matches[1];
                        $endCol = $matches[2];
                        $sheet->mergeCells("{$startCol}{$row}:{$endCol}{$row}");
                    }
                }
            }

            $sheet->setCellValue("A{$row}", $index + 1);
            $sheet->setCellValue("B{$row}", $doc->ma_phan);
            $sheet->setCellValue("C{$row}", $doc->ten_phan);
            $sheet->setCellValue("D{$row}", $doc->id_product);
            $sheet->setCellValue("E{$row}", '3808');
            $sheet->setCellValue("F{$row}", '2024 trở về sau');
            $sheet->setCellValue("G{$row}", $doc->brand);
            $sheet->setCellValue("H{$row}", $doc->country);
            $sheet->setCellValue("I{$row}", $doc->quantity);
            $sheet->setCellValue("J{$row}", $doc->unit);
            $sheet->setCellValue("K{$row}", $doc->price);
            $sheet->setCellValue("L{$row}", 'Đã bao gồm');
            $sheet->setCellValue("M{$row}", '');
            $sheet->setCellValue("N{$row}", $doc->price * $doc->quantity);
            $sheet->setCellValue("O{$row}", $doc->thong_so_ky_thuat_co_ban);
            $sheet->setCellValue("P{$row}", $doc->quy_cach);
        }

        $sheet->setCellValue("C" . ($newFooterRow), str_replace('{{day}}', $today->day, $sheet->getCell("C" . ($newFooterRow))->getValue()));
        $sheet->setCellValue("C" . ($newFooterRow), str_replace('{{month}}', $today->month, $sheet->getCell("C" . ($newFooterRow))->getValue()));
        $sheet->setCellValue("C" . ($newFooterRow), str_replace('{{year}}', $today->year, $sheet->getCell("C" . ($newFooterRow))->getValue()));
        $cell = "N" . ($newFooterRow + 1);
        $text = $sheet->getCell($cell)->getValue();

        $text = str_replace('{{day}}', $today->day, $text);
        $text = str_replace('{{month}}', $today->month, $text);
        $text = str_replace('{{year}}', $today->year, $text);

        $richText = new RichText();

        $parts = explode('{{daidien}}', $text);
        $normalText = $richText->createTextRun($parts[0]);
        $normalText->getFont()->setName('Times New Roman');

        $boldRun1 = $richText->createTextRun("Đại diện hợp pháp của hãng sản xuất, nhà cung cấp");
        $boldRun1->getFont()->setBold(true)->setName('Times New Roman');

        if (isset($parts[1])) {
            $subParts = explode('{{position}}', $parts[1]);
            if (isset($subParts[0])) {
                $middleText = $richText->createTextRun($subParts[0]);
                $middleText->getFont()->setName('Times New Roman');
            }

            if (isset($subParts[1])) {
                $boldRun2 = $richText->createTextRun("Giám đốc");
                $boldRun2->getFont()->setBold(true)->setName('Times New Roman');

                $remainingText = $richText->createTextRun($subParts[1]);
                $remainingText->getFont()->setName('Times New Roman');
            }
        }

        $sheet->getCell($cell)->setValue($richText);
        $filename = 'bao_gia_' . now()->format('Ymd_His') . '.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $temp_file = storage_path($filename);
        $writer->save($temp_file);

        return response()->download($temp_file)->deleteFileAfterSend(true);
    }
    public function convertNumberToWords($number)
    {
        // Mảng chữ số đơn vị
        $units = [
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín'
        ];

        // Mảng đơn vị hàng
        $blocks = ['', 'nghìn', 'triệu', 'tỷ', 'nghìn tỷ', 'triệu tỷ'];

        // Làm tròn số và chuyển thành số nguyên
        $number = round($number, 0);
        if ($number == 0) {
            return 'Không đồng';
        }

        // Chuyển số thành chuỗi và loại bỏ các ký tự không phải số
        $number = (string)$number;
        $number = preg_replace('/[^0-9]/', '', $number);

        // Chia số thành các khối 3 chữ số
        $blocks_num = ceil(strlen($number) / 3);
        $number = str_pad($number, $blocks_num * 3, '0', STR_PAD_LEFT);
        $blocks_array = str_split($number, 3);

        // Hàm đọc 1 khối 3 chữ số
        $readBlock = function ($block) use ($units) {
            $hundred = floor($block / 100);
            $ten = floor(($block % 100) / 10);
            $unit = $block % 10;

            $result = '';

            if ($hundred > 0) {
                $result .= $units[$hundred] . ' trăm ';
            }

            if ($ten > 0) {
                if ($ten == 1) {
                    $result .= 'mười ';
                } else {
                    $result .= $units[$ten] . ' mươi ';
                }

                if ($unit == 1 && $ten > 1) {
                    $result .= 'mốt';
                } elseif ($unit == 5 && $ten > 0) {
                    $result .= 'lăm';
                } elseif ($unit == 0) {
                    $result = rtrim($result);
                } elseif ($unit > 0) {
                    $result .= $units[$unit];
                }
            } else {
                if ($unit > 0) {
                    $result .= $units[$unit];
                }
            }

            return trim($result);
        };

        $result = '';
        foreach ($blocks_array as $i => $block) {
            $block_num = (int)$block;
            if ($block_num > 0) {
                $block_text = $readBlock($block_num);
                $position = $blocks_num - $i - 1;
                $result .= $block_text;
                if (isset($blocks[$position])) {
                    $result .= ' ' . $blocks[$position];
                }
                $result .= ' ';
            }
        }

        $result = trim($result) . ' đồng';

        // Viết hoa chữ cái đầu
        $result = ucfirst($result);

        return $result;
    }

    public function bid()
    {
        $user = Auth::user();

        $documents = Document::with(['bidder.category', 'group'])
            ->where('type', 'dauthau')
            ->where('status', 'datrung')
            ->when(!$user->is_admin, function ($query) use ($user) {
                $query->whereHas('group', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        $totals = $documents->groupBy('group_id')->map(function ($group) {
            return [
                'code_category_bidder' => $group->first()->code_category_bidder,
                'id_product' => $group->first()->id_product,
                'total_price' => $group->sum('total_price'),
                'bidder_name' => $group->first()->bidder->category->name ?? 'Không xác định',
                'group' => $group->first()->group->name ?? 'Không xác định',
                'group_id' => $group->first()->group->id ?? 'Không xác định',
            ];
        });

        $documents = $totals->values();

        $details = Document::all();

        return view('pages.document.bid_list', compact('documents', 'details'));
    }


    public function bidDetail($code, $group)
    {
        $categories = CategoryBidder::all();
        $products = Product::all();

        $documents = Document::with(['bidder', 'product'])
            ->where('code_category_bidder', $code)
            ->where('group_id', $group)
            ->where('status', 'datrung')
            ->get();
        $allDocument = Document::with(['bidder', 'product'])
            ->where('code_category_bidder', $code)
            ->where('group_id', $group)
            ->get();
        $total_orginal = $documents->sum(function ($doc) {
            return ($doc->product->gia_von ?? 0) * ($doc->quantity ?? 0);
        });
        $totalAmount = $allDocument->sum('total_price');

        $totalDocuments = $allDocument->count();

        $trungDocuments = $documents->count();

        $rate = $trungDocuments . '/' . $totalDocuments;
        $percent = $totalDocuments > 0 ? round($trungDocuments / $totalDocuments * 100, 2) : 0;

        $totalTrung = $documents->where('status', 'datrung')->sum('total_price');

        return view('pages.document.bid_edit', compact('categories', 'products', 'documents', 'total_orginal', 'totalAmount', 'rate', 'percent', 'totalTrung'));
    }

    public function bidUpdate(Request $request)
    {
        $documents = Document::all()->keyBy('id');
        foreach ($request->products as $product) {
            $document = $documents[$product['id']] ?? null;
            if (!$document) continue;

            if (is_null($document->so_luong_da_giao)) {
                $so_luong_da_giao_moi = $product['so_luong_giao'];
            } else {
                $so_luong_da_giao_moi = $document->so_luong_da_giao + $product['so_luong_giao'];
            }

            if (is_null($document->so_luong_con_lai)) {
                $so_luong_con_lai_moi = $product['so_luong_con_lai'];
            } else {
                $so_luong_con_lai_moi = $document->so_luong_con_lai - $product['so_luong_giao'];
            }

            $document->update([
                'so_luong_da_giao' => $so_luong_da_giao_moi,
                'so_luong_con_lai' => $so_luong_con_lai_moi,
            ]);

            DocumentLog::create([
                'document_id' => $product['id'],
                'group_id' => $product['group_id'],
                'so_luong_da_giao' => $product['so_luong_giao'],
                'so_luong_con_lai' => $product['so_luong_con_lai'],
            ]);
        }

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }


    public function docLogs()
    {
        $documents = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'dauthau')
            ->where('status', 'datrung')
            ->whereNotNull('so_luong_da_giao')
            ->get();

        $details = [];
        $logsByBidderCode = [];
        $logsByGroupId = [];

        foreach ($documents as $document) {
            // Lấy logs của document theo document_id
            $logs = DocumentLog::where('document_id', $document->id)
                ->with('document')
                ->get();

            // Lưu logs vào details
            $details[$document->id] = $logs;


            // Nhóm logs theo group_id
            if ($document->group_id) {
                if (!isset($logsByGroupId[$document->group_id])) {
                    $logsByGroupId[$document->group_id] = [];
                }
                $logsByGroupId[$document->group_id] = array_merge(
                    $logsByGroupId[$document->group_id],
                    $logs->toArray()
                );
            }
        }

        // Tính tổng theo group_id của document
        $totals = $documents->groupBy('group_id')->map(function ($group) {
            $updateAt = Carbon::parse($group->first()->updated_at)->format('H:i d/m/Y ');
            return [
                'code_category_bidder' => $group->first()->code_category_bidder,
                'id' => $group->first()->id,
                'id_product' => $group->first()->id_product,
                'total_price' => $group->sum('total_price'),
                'bidder_name' => $group->first()->bidder->category->name ?? 'Không xác định',
                'group' => $group->first()->group->name ?? 'Không xác định',
                'group_id' => $group->first()->group->id ?? 'Không xác định',
                'updated_at' => $updateAt,
            ];
        });

        $documents = $totals->values();

        return view('pages.document.document_log', compact('documents', 'details', 'logsByGroupId'));
    }

    public function docLogDetail($code, $group)
    {
        $documents = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'dauthau')
            ->where('code_category_bidder', $code)
            ->where('group_id', $group)
            ->where('status', 'datrung')
            ->get();
        $details = [];
        $logsByGroupId = [];

        foreach ($documents as $document) {
            $logs = DocumentLog::where('document_id', $document->id)
                ->with('document')
                ->orderBy('created_at', 'desc')
                ->get();

            $details[$document->id] = $logs;

            foreach ($logs as $log) {
                $createdAt = Carbon::parse($log->created_at)->format('H:i Y/m/d');

                if (!isset($logsByGroupId[$document->group_id][$createdAt])) {
                    $logsByGroupId[$document->group_id][$createdAt] = [];
                }

                $logsByGroupId[$document->group_id][$createdAt][] = $log;
            }
        }
        return view('pages.document.document_log_detail', compact('logsByGroupId'));
    }
}
