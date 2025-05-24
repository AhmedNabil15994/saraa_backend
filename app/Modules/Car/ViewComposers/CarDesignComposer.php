<?php

namespace App\Modules\Car\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CarCrudRepository;

class CarDesignComposer
{
    public $designElems = [];

    public function __construct(CarCrudRepository  $crudDesign)
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
