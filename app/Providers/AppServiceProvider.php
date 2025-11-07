<?php

namespace App\Providers;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

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
        //Share the setting data with all view pages

        $setting_data = Setting::where('id',1)->first();

        view()->share('global_setting',$setting_data);
    }
}
