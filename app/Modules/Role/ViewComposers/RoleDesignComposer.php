<?php

namespace App\Modules\Role\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\RoleCrudRepository;

class RoleDesignComposer
{
    public $designElems = [];

    public function __construct(RoleCrudRepository  $roleCrud)
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
