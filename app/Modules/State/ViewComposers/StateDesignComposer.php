<?php

namespace App\Modules\State\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\StateCrudRepository;

class StateDesignComposer
{
    public $designElems = [];

    public function __construct(StateCrudRepository  $crudDesign)
    {
        $this->designElems = $crudDesign->getSpecificData(['all']);
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
