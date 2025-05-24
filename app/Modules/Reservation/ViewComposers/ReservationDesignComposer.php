<?php

namespace App\Modules\Reservation\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\ReservationCrudRepository;

class ReservationDesignComposer
{
    public $designElems = [];

    public function __construct(ReservationCrudRepository  $crudDesign)
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
