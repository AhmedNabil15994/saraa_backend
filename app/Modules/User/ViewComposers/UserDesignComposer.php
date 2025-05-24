<?php

namespace App\Modules\User\ViewComposers;

use Illuminate\View\View;
use Cache;
use App\Repositories\UserCrudRepository;

class UserDesignComposer
{
    public $designElems = [];

    public function __construct(UserCrudRepository  $userCrud)
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
