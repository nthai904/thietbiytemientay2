<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\GroupBidder;

use App\Models\Notification;

class CheckBidClosingDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-bid-closing-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra gói thầu đến ngày đóng thầu và gửi thông báo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDate = Carbon::today()->addDays(2)->toDateString();

        $targetDate = Carbon::today()->addDays(2)->toDateString();

        $bids = GroupBidder::where('ngay_dong_thau', $targetDate)->get();

        foreach ($bids as $bid) {
            Notification::create([
                'user_id' => $bid->user_id,
                'group_id' => $bid->id,
                'title' => 'Thông báo sắp đến ngày đóng thầu',
                'content' => "Gói thầu '{$bid->name}' sẽ đóng thầu sau 2 ngày.",
                'status' => 'new',
            ]);
            Notification::create([
                'user_id' => 1,
                'group_id' => $bid->id,
                'title' => 'Thông báo sắp đến ngày đóng thầu',
                'content' => "Gói thầu '{$bid->name}' sẽ đóng thầu sau 2 ngày.",
                'status' => 'new',
            ]);
        }

        $this->info('Đã gửi thông báo trước 2 ngày cho các gói thầu.');
    }
}
