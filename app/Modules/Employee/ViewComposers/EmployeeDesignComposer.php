<?php

namespace App\Modules\Employee\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\EmployeeCurdRepository;

class EmployeeDesignComposer
{
    public $designElems = [];

    public function __construct(EmployeeCurdRepository  $userCrud)
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
