<?php

namespace App\Modules\ContactUs\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\ContactUsCrudRepository;

class ContactUsDesignComposer
{
    public $designElems = [];

    public function __construct(ContactUsCrudRepository  $contactUsCrud)
    {
        $this->designElems = $contactUsCrud->getSpecificData(['all']);
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
