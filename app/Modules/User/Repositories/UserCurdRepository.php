<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

class UserCrudRepository implements DesignInterface
{

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'name' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '1',
                'label' => trans('User::user.form.name'),
            ],
            'mobile' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '1',
                'label' => trans('User::user.form.mobile'),
            ],
            'email' => [
                'type' => 'email',
                'class' => 'form-control datatable-input',
                'index' => '2',
                'label' => trans('User::user.form.email'),
            ],
            'role_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('User::user.form.role'),
                'options' => \App\Entities\Role::get(['id',"name_".LANGUAGE_PREF." as title"]),
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function toggleData(): array
    {
        return  [
            'status' => [
                'type' => 'toggle',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Dashboard::dashboard.showInActive'),
                'checked' => true,
            ],
            'deleted_at' => [
                'type' => 'toggle',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Dashboard::dashboard.showItems'),
                'checked' => false,
            ],
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function tableData()
    {
        return [
            'id' => [
                'label' => trans('Dashboard::dashboard.id'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
            'image' => [
                'label' => trans('Dashboard::dashboard.image'),
                'type' => 'image',
                'className' => '',
                'data-col' => 'image_url',
                'anchor-class' => '',
            ],
            'name' => [
                'label' => trans('User::user.form.name'),
                'type' => '',
                'className' => '',
                'data-col' => 'name',
                'anchor-class' => '',
            ],
            'mobile' => [
                'label' => trans('User::user.form.mobile'),
                'type' => '',
                'className' => 'dir-ltr',
                'data-col' => 'mobile',
                'anchor-class' => '',
            ],
            'email' => [
                'label' => trans('User::user.form.email'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'email',
                'anchor-class' => 'editable',
            ],
            'role_name' => [
                'label' => trans('User::user.form.role'),
                'type' => '',
                'className' => '',
                'data-col' => 'role_id',
                'anchor-class' => '',
            ],
            'last_login' => [
                'label' => trans('User::user.form.last_login'),
                'type' => '',
                'className' => '',
                'data-col' => 'last_login',
                'anchor-class' => '',
            ],
            'status' => [
                'label' => trans('User::user.form.status'),
                'type' => '',
                'className' => '',
                'data-col' => 'status',
                'anchor-class' => '',
            ],
            'actions' => [
                'label' => trans('Dashboard::dashboard.actions'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function addData()
    {
        return[
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function editData()
    {
        return[
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('User::user.title'),
            'url' => 'dashboard/'.'users',
            'name' => 'users',
            'nameOne' => 'user',
            'modelName' => 'User',
            'icon' => ' fas fa-user',
            'sortName' => '',
            'addOne' => trans('User::user.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getSpecificData($types=[])
    {
        $data = [];
        if(in_array('main',$types)){
            $data['mainData'] = $this->mainData();
        }

        if(in_array('search',$types)){
            $data['searchData'] = $this->searchData();
            $data['toggleData'] = $this->toggleData();
        }

        if(in_array('table',$types)){
            $data['tableData'] = $this->tableData();
        }

        if(in_array('add',$types)){
            $data['modelData'] = $this->addData();
        }

        if(in_array('edit',$types)){
            $data['modelData'] = $this->editData();
        }

        if(in_array('all',$types)){
            $data = [
                'mainData' => $this->mainData(),
                'searchData' => $this->searchData(),
                'toggleData' => $this->toggleData(),
                'tableData' => $this->tableData(),
                'modelData' => $this->addData(),
            ];
        }
        return $data;
    }
}
