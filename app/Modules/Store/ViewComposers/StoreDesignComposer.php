<?php

namespace App\Modules\Store\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\StoreCrudRepository;

class StoreDesignComposer
{
    public $designElems = [];

    public function __construct(StoreCrudRepository  $crudDesign)
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
