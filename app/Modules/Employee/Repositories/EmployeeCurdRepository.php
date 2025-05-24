<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

class EmployeeCurdRepository implements DesignInterface
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
                'label' => trans('Employee::employee.form.name'),
            ],
            'mobile' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '1',
                'label' => trans('Employee::employee.form.mobile'),
            ],
            'email' => [
                'type' => 'email',
                'class' => 'form-control datatable-input',
                'index' => '2',
                'label' => trans('Employee::employee.form.email'),
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
                'label' => trans('Employee::employee.form.name'),
                'type' => '',
                'className' => '',
                'data-col' => 'name',
                'anchor-class' => '',
            ],
            'mobile' => [
                'label' => trans('Employee::employee.form.mobile'),
                'type' => '',
                'className' => 'dir-ltr',
                'data-col' => 'mobile',
                'anchor-class' => '',
            ],
            'email' => [
                'label' => trans('Employee::employee.form.email'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'email',
                'anchor-class' => 'editable',
            ],
            'last_login' => [
                'label' => trans('Employee::employee.form.last_login'),
                'type' => '',
                'className' => '',
                'data-col' => 'last_login',
                'anchor-class' => '',
            ],
            'status' => [
                'label' => trans('Employee::employee.form.status'),
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
            'title' => trans('Employee::employee.title'),
            'url' => 'dashboard/'.'employees',
            'name' => 'employees',
            'nameOne' => 'employee',
            'modelName' => 'User',
            'icon' => ' fas fa-user',
            'sortName' => '',
            'addOne' => trans('Employee::employee.newOne'),
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
