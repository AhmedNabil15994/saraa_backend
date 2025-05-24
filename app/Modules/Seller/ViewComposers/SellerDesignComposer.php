<?php

namespace App\Modules\Seller\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\SellerCurdRepository;

class SellerDesignComposer
{
    public $designElems = [];

    public function __construct(SellerCurdRepository  $userCrud)
    {
        $this->designElems = $userCrud->getSpecificData(['all']);
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
