<?php

namespace App\Modules\CarType\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CarTypeCrudRepository;

class CarTypeDesignComposer
{
    public $designElems = [];

    public function __construct(CarTypeCrudRepository  $crudDesign)
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
