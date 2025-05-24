<?php

namespace App\Modules\EmployeeRole\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Entities\Role;

class EmployeeRoleComposer
{
    public $emp_permissions = [];
    public $emp_roles = [];

    public function __construct()
    {
        $this->emp_permissions = \Helper::getPermissions();
        $this->emp_roles = Role::adminView()->get(['id',"name_".LANGUAGE_PREF." as display_name"]);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('emp_permissions' , $this->emp_permissions);
        $view->with('emp_roles' , $this->emp_roles);
    }
}
