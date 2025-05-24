<?php

namespace App\Modules\CarModel\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CarModelCrudRepository;

class CarModelDesignComposer
{
    public $designElems = [];

    public function __construct(CarModelCrudRepository  $crudDesign)
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
