<?php

namespace App\Modules\Brand\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\BrandCrudRepository;

class BrandDesignComposer
{
    public $designElems = [];

    public function __construct(BrandCrudRepository  $crudDesign)
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
