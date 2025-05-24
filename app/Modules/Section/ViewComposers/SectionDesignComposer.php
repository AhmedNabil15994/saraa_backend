<?php

namespace App\Modules\Section\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\SectionCrudRepository;

class SectionDesignComposer
{
    public $designElems = [];

    public function __construct(SectionCrudRepository  $sectionCrud)
    {
        $this->designElems = $sectionCrud->getSpecificData(['all']);
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
