<?php

namespace App\Http\Controllers;

use App\Models\CategoryBidder;
use App\Models\City;
use App\Models\Document;
use App\Models\GroupBidder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $documents = Document::where('type', 'dauthau')->distinct('group_id')->count('group_id');
        $document_bid = Document::where('type', 'dauthau')->distinct('group_id')->where('status', 'datrung')->count('group_id');
        $total_bid = Document::where('type', 'dauthau')->distinct('group_id')->count('group_id');
        $bid_rate = 0;
        if ($total_bid > 0) {
            $bid_rate = round(($document_bid / $total_bid) * 100, 2);
        }
        $cities = City::all();
        $user = User::where('is_admin', 0)->get();
        foreach ($user as $u) {
            $document_bid_by_user = Document::join('group_bidder', 'bidding_document.group_id', '=', 'group_bidder.id')->where('bidding_document.type', 'dauthau')->where('bidding_document.status', 'datrung')->where('group_bidder.user_id', $u->id)->distinct()->count('bidding_document.group_id');
            $exchange_by_user = Document::where('type', 'banle')->where('user_id', $u->id)->distinct()->count('created_at');
            $exchanges[$u->id] = $exchange_by_user;
            $results[$u->id] = $document_bid_by_user;
        }
        $city_stats = CategoryBidder::select(
            'cities.name as city_name',
            'category_bidder.city',
            DB::raw('COUNT(DISTINCT bidding_document.group_id) as total_categories')
        )
            ->join('cities', 'category_bidder.city', '=', 'cities.id')
            ->join('bidding_document', 'category_bidder.code', '=', 'bidding_document.code_category_bidder')
            ->whereNotNull('bidding_document.code_category_bidder')
            ->groupBy('category_bidder.city', 'cities.name')
            ->orderByDesc('total_categories')
            ->get();
        $group_bidder = GroupBidder::orderBy('created_at', 'desc')->get();
        $query_exchange = Document::with('bidder')
            ->orderBy('created_at', 'desc')
            ->where('type', 'banle')->get();
        $totals = $query_exchange->groupBy('created_at')->map(function ($group) {
            $firstItem = $group->first();
            $createdAt = Carbon::parse($firstItem->created_at)->format('H:i d/m/Y ');
            $date_slug = Carbon::parse($firstItem->created_at)->format('HisdmY');
            return [
                'id' => $firstItem->id,
                'user_id' => $firstItem->user_id,
                'code_category_bidder' => $firstItem->code_category_bidder,
                'created_at' => $createdAt,
                'date_slug' => $date_slug,
                'total_price' => $group->sum('total_price'),
                'bidder_name' => $firstItem->category->name ?? 'Không xác định',
            ];
        });
        $exchange_detail = $totals->values();
        return view('pages.dashboard.index', compact('documents', 'document_bid', 'bid_rate', 'user', 'results','exchanges', 'city_stats', 'group_bidder', 'exchange_detail'));
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
