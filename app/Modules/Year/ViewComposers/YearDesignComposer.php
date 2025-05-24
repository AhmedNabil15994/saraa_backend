<?php

namespace App\Modules\Year\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\YearCrudRepository;

class YearDesignComposer
{
    public $designElems = [];

    public function __construct(YearCrudRepository  $crudDesign)
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
