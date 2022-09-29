<?php

namespace App\View\Composers;

use App\Models\SharedModel\MainAppSetting;
use App\Repositories\UserRepository;
use Illuminate\View\View;

class NavbarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = MainAppSetting::first();
        $view->with('data', $data);
    }
}
