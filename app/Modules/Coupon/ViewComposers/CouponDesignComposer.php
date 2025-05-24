<?php

namespace App\Modules\Coupon\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CouponCrudRepository;

class CouponDesignComposer
{
    public $designElems = [];

    public function __construct(CouponCrudRepository  $crudDesign)
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
