<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $unreadMessages = 0;

            if (Auth::check()) {
                $unreadMessages = Message::where('receiver_id', Auth::id())
                    ->where('status', false)
                    ->count();
            }

            $view->with('unreadMessages', $unreadMessages);
        });
    }
}
