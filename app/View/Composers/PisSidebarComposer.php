<?php

namespace App\View\Composers;

use App\Models\SharedModel\Setting;
use Illuminate\View\View;

class PisSidebarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = Setting::query()->UpdatedIn(config('constant.app_name_pis'))->get();
        $view->with('data', $data);
    }
}
