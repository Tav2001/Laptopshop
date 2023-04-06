<?php

namespace App\Providers;

use App\LienHe;
use App\NSX;
use App\PhieuXuat;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

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
        Carbon::setLocale($this->app->getLocale());

        view()->composer('*', function ($view) {
            $hangsx = NSX::where('loaihang', 0)->get();
            $hangsx_pk = NSX::where('loaihang', 1)->get();
            $view->with(compact('hangsx', 'hangsx_pk'));
        });

        view()->composer('LayoutAdmin', function ($view) {
            $tinhtrang_dhg = PhieuXuat::where('tinhtranggiaohang', 1)->orderby('madonhang', 'desc')->get();
            $tinhtrang_lienhe = LienHe::where('trangthai', 0)->orderby('maLH', 'desc')->get();
            $view->with(compact('tinhtrang_dhg', 'tinhtrang_lienhe'));
        });
    }
}