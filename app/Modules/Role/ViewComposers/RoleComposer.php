<?php

namespace App\Modules\Role\ViewComposers;

use Illuminate\View\View;
use Cache;

class RoleComposer
{
    public $permissions = [];

    public function __construct()
    {
        $this->permissions = \Helper::getPermissions();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissions' , $this->permissions);
    }
}
