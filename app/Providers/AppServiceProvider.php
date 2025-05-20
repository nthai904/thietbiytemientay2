<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('vi');
        View::composer('components.header', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $notifications = Notification::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $countUnread = $notifications->where('status', 'new')->count();
                $view->with([
                    'notifications' => $notifications,
                    'countUnread' => $countUnread,
                ]);
            }
        });
    }
}
