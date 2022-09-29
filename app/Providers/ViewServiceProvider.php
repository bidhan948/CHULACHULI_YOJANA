<?php

namespace App\Providers;

use App\View\Composers\ByabasayeSidebarComposer;
use App\View\Composers\MalpotSidebarComposer;
use App\View\Composers\NavbarComposer;
use App\View\Composers\PisSidebarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        View::composer('layout.navbar', NavbarComposer::class);
        View::composer('layout.pis_sidebar', PisSidebarComposer::class);
        View::composer('layout.byabasaye_sidebar', ByabasayeSidebarComposer::class);
        View::composer('layout.malpot_sidebar', MalpotSidebarComposer::class);
    }
}
