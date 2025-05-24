<?php

namespace App\Modules\Slider\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\SliderCrudRepository;

class SliderDesignComposer
{
    public $designElems = [];

    public function __construct(SliderCrudRepository  $sliderCrud)
    {
        $this->designElems = $sliderCrud->getSpecificData(['all']);
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
