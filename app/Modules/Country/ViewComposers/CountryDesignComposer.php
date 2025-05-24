<?php

namespace App\Modules\Country\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\CountryCrudRepository;

class CountryDesignComposer
{
    public $designElems = [];

    public function __construct(CountryCrudRepository  $crudDesign)
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
