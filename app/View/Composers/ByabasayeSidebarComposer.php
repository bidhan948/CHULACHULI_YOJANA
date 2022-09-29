<?php

namespace App\View\Composers;

use App\Models\SharedModel\Setting;
use Illuminate\View\View;

class ByabasayeSidebarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = Setting::query()->UpdatedIn(config('constant.app_name_byabasaye'))->get();
        $view->with('data', $data);
    }
}
