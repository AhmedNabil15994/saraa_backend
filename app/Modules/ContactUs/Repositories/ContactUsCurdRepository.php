<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

class ContactUsCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('ContactUs::contactUs.title'),
            'url' => 'dashboard/'.'contactUs',
            'name' => 'contactuses',
            'nameOne' => 'contactUs',
            'modelName' => 'ContactUs',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('ContactUs::contactUs.newOne'),
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
    public function searchData(): array
    {
        return  [
            'name' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '1',
                'label' => trans('ContactUs::contactUs.form.name'),
            ],
            'email' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '2',
                'label' => trans('ContactUs::contactUs.form.email'),
            ],
            'phone' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '2',
                'label' => trans('ContactUs::contactUs.form.phone'),
            ],
            'date' => [
                'type' => 'text',
                'class' => 'form-control datepicker-input datepicker',
                'index' => '2',
                'label' => trans('Blog::blog.form.date'),
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
            'name' => [
                'label' => trans('ContactUs::contactUs.form.name'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'name',
                'anchor-class' => 'editable',
            ],
            'email' => [
                'label' => trans('ContactUs::contactUs.form.email'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'email',
                'anchor-class' => 'editable',
            ],
            'phone' => [
                'label' => trans('ContactUs::contactUs.form.phone'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'phone',
                'anchor-class' => 'editable',
            ],
            'status' => [
                'label' => trans('Section::section.form.status'),
                'type' => '',
                'className' => '',
                'data-col' => 'status',
                'anchor-class' => '',
            ],
            'created_at' => [
                'label' => trans('Blog::blog.form.date'),
                'type' => '',
                'className' => '',
                'data-col' => 'created_at',
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
