<?php

namespace App\Modules\Dashboard\ViewComposers;

use Illuminate\View\View;
use Cache;

class DashboardComposer
{
    public $available_locales = [];

    public function __construct()
    {
        $this->available_locales =  config('modules.available_locales');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('available_locales' , $this->available_locales);
    }
}
