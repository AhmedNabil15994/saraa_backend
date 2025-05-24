<?php

namespace App\Modules\Blog\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\BlogCrudRepository;

class BlogDesignComposer
{
    public $designElems = [];

    public function __construct(BlogCrudRepository  $blogCrud)
    {
        $this->designElems = $blogCrud->getSpecificData(['all']);
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
