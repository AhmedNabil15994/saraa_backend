<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

class CategoryCrudRepository implements DesignInterface
{

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
            'parent_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Category::category.form.parent'),
                'options' => \App\Entities\Category::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as title"]),
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
            'name_ar' => [
                'label' => trans('Category::category.form.name_ar'),
                'type' => '',
                'className' => '',
                'data-col' => 'name_ar',
                'anchor-class' => '',
            ],
            'name_en' => [
                'label' => trans('Category::category.form.name_en'),
                'type' => '',
                'className' => '',
                'data-col' => 'name_en',
                'anchor-class' => '',
            ],
            'parent_name' => [
                'label' => trans('Category::category.form.parent'),
                'type' => '',
                'className' => '',
                'data-col' => 'parent_id',
                'anchor-class' => '',
            ],
            'status' => [
                'label' => trans('Category::category.form.status'),
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
            'title' => trans('Category::category.title'),
            'url' => 'dashboard/'.'categories',
            'name' => 'categories',
            'nameOne' => 'category',
            'modelName' => 'Category',
            'icon' => ' icon-2x la la-group',
            'sortName' => '',
            'addOne' => trans('Category::category.newOne'),
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
