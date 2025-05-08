<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidder;
use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\Document;
use App\Models\GroupBidder;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'dauthau')
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
            return back()->withErrors(['message' => 'Không tìm thấy nhà thầu!']);
        }

        $productIds = $request->id_product;
        $giaduthau = $request->giaduthau;
        $thanhtien = $request->thanhtien;
        $extra_price = $request->extra_price;
        $group = $request->group;
        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->withErrors(['message' => 'Thông tin sản phẩm hoặc giá trị không hợp lệ!']);
        }

        foreach ($productIds as $index => $id) {
            $product = Product::where('code', $id)->first();
            $bidder = $bidders->get($index);

            if ($product && $bidder) {
                Document::create([
                    'ma_phan'              => $bidder->ma_phan,
                    'ten_phan'             => $bidder->ten_phan,
                    'code_category_bidder' => $request->id_nhathau,
                    'unit'                 => $product->unit,
                    'quantity'             => $bidder->quantity,
                    'product_name'         => $product->name,
                    'quy_cach'             => $product->quy_cach,
                    'brand'                => $product->brand,
                    'country'              => $product->country,
                    'price'                => $giaduthau[$index] ?? 0,
                    'total_price'          => $thanhtien[$index] ?? 0,
                    'id_product'           => $product->code,
                    'extra_price'          => $extra_price[$index] ?? 0,
                    'product_name_bidder'  => $bidder->product_name,
                    'type'                 => 'dauthau',
                    'group_id'             => $group,
                ]);
            }
        }

        return redirect()->route('document.index')->with('success', 'Tạo document thành công!');
    }

    public function edit($code, $group)
    {
        $categories = CategoryBidder::all();
        $products = Product::all();

        $documents = Document::with(['bidder', 'product'])
            ->where('code_category_bidder', $code)
            ->where('group_id', $group)
            ->get();

        $total_orginal = $documents->sum(function ($doc) {
            return ($doc->product->price ?? 0) * ($doc->quantity ?? 0);
        });
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
        $productIds  = $request->id_product;
        $giaduthau   = $request->giaduthau;
        $thanhtien   = $request->thanhtien;
        $extra_price = $request->extra_price;
        $status    = $request->status;

        if (empty($productIds) || empty($giaduthau) || empty($thanhtien)) {
            return back()->withErrors(['message' => 'Thiếu thông tin cập nhật!']);
        }

        $documents = Document::where('code_category_bidder', $code)->where('group_id', $group)->get();
        foreach ($documents as $index => $doc) {
            if (
                isset($productIds[$index], $giaduthau[$index], $thanhtien[$index], $extra_price[$index], $status[$index])
            ) {
                $product = Product::where('code', $productIds[$index])->first();

                if ($product) {
                    $doc->update([
                        'id_product'    => $product->code,
                        'product_name'  => $product->name,
                        'unit'          => $product->unit,
                        'quy_cach'      => $product->quy_cach,
                        'brand'         => $product->brand,
                        'country'       => $product->country,
                        'price'         => $giaduthau[$index],
                        'total_price'   => $thanhtien[$index],
                        'extra_price'   => $extra_price[$index],
                        'status'        => $status[$index],
                    ]);
                }
            }
        }


        return redirect()->route('document.index')->with('success', 'Cập nhật thành công!');
    }

    public function exportExcel(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);

        $documents = Document::whereIn('code_category_bidder', $selectedRows)->get();

        if ($documents->isEmpty()) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = storage_path('app/public/template.xlsx');
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
            $sheet->setCellValue("K{$rowIndex}", $document->product->country);
            $sheet->setCellValue("L{$rowIndex}", $document->product->brand);
            $sheet->setCellValue("M{$rowIndex}", $document->product->detail);
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
        $documents = Document::whereIn('code_category_bidder', $selectedRows)->get();

        if ($documents->isEmpty()) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = storage_path('app/public/template.docx');
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
            $templateProcessor->setValue("product_name_bidder#{$rowIndex}", $document->product_name_bidder);
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

    public function exportContract(Request $request)
    {
        $selectedRows = json_decode($request->selectedRows, true);

        // Lấy các document có trong danh sách được chọn
        $documents = Document::with('bidder.category')
            ->whereIn('code_category_bidder', $selectedRows)
            ->get();

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
        $templatePath = storage_path('app/public/hopdong.docx');
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
            'unit',
            'quantity',
            'price',
            'total_price',
            'code_category_bidder'
        ])
            ->whereIn('code_category_bidder', $selectedRows)
            ->get()
            ->toArray();
        $position = CategoryBidder::where('code', $documents[0]['code_category_bidder'])->first();

        if (empty($documents)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }

        $templatePath = storage_path('app/public/mau_phuluc2.xlsx');
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
                '',
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
        $documents = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'dauthau')
            ->where('status', 'datrung')
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

        $total_orginal = $documents->sum(function ($doc) {
            return ($doc->product->price ?? 0) * ($doc->quantity ?? 0);
        });
        $totalAmount = $documents->sum('total_price');

        $totalDocuments = $documents->count();
        $trungDocuments = $documents->where('status', 'datrung')->count();

        $rate = $trungDocuments . '/' . $totalDocuments;
        $percent = $totalDocuments > 0 ? round($trungDocuments / $totalDocuments * 100, 2) : 0;

        $totalTrung = $documents->where('status', 'datrung')->sum('total_price');

        return view('pages.document.bid_edit', compact('categories', 'products', 'documents', 'total_orginal', 'totalAmount', 'rate', 'percent', 'totalTrung'));
    }
}
