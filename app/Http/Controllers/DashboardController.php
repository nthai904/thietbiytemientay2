<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $documents = Document::where('type', 'dauthau')
            ->distinct('group_id')
            ->count('group_id');

        $document_bid = Document::where('type', 'dauthau')
            ->distinct('group_id')
            ->where('status', 'datrung')
            ->count('group_id');
        $total_bid = Document::where('type', 'dauthau')
            ->distinct('group_id')
            ->count('group_id');

        $bid_rate = 0;
        if ($total_bid > 0) {
            $bid_rate = round(($document_bid / $total_bid) * 100, 2); 
        }
        return view('pages.dashboard.index', compact('documents', 'document_bid', 'bid_rate'));
    }

    public function show($id)
    {
        return view('dashboard.show', ['id' => $id]);
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function edit($id)
    {
        return view('dashboard.edit', ['id' => $id]);
    }
}
