<?php

namespace App\Modules\Page\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\PageCrudRepository;

class PageDesignComposer
{
    public $designElems = [];

    public function __construct(PageCrudRepository  $pageCrud)
    {
        $this->designElems = $pageCrud->getSpecificData(['all']);
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
