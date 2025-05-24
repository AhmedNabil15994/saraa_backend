<?php

namespace App\Modules\Category\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CategoryCrudRepository;

class CategoryDesignComposer
{
    public $designElems = [];

    public function __construct(CategoryCrudRepository  $categoryCrud)
    {
        $this->designElems = $categoryCrud->getSpecificData(['all']);
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
