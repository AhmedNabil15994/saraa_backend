<?php

namespace App\Modules\City\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CityCrudRepository;

class CityDesignComposer
{
    public $designElems = [];

    public function __construct(CityCrudRepository  $crudDesign)
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
