<?php

namespace App\Modules\EmployeeRole\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\EmployeeRoleCrudRepository;

class EmployeeRoleDesignComposer
{
    public $designElems = [];

    public function __construct(EmployeeRoleCrudRepository  $roleCrud)
    {
        $this->designElems = $roleCrud->getSpecificData(['all']);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('designElems' , $this->designElems);
    }
}
