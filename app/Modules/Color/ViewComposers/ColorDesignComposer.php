<?php

namespace App\Modules\Color\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\ColorCrudRepository;

class ColorDesignComposer
{
    public $designElems = [];

    public function __construct(ColorCrudRepository  $crudDesign)
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
