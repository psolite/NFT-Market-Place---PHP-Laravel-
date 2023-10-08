<?php

namespace App\Providers;

use App\Models\Email;
use App\Models\Mint;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


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
        $data['settingsc'] = Setting::where('id', 1)->first();
        $data['pagesc'] = Page::get();
        
        View::share($data);
        
        Schema::defaultStringLength(191);

    }
}
