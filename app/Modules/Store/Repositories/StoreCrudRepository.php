<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;
use App\Entities\State;
use App\Transformers\StateResource;
use App\Entities\City;
use App\Transformers\CityResource;

class StoreCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('Store::store.title'),
            'url' => 'dashboard/'.'stores',
            'name' => 'stores',
            'nameOne' => 'store',
            'modelName' => 'Store',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('Store::store.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'state_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Store::store.form.state'),
                'options' => StateResource::collection(State::active()->get()),
            ],
            'city_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Store::store.form.city'),
                'options' => CityResource::collection(City::active()->get()),
            ],
            'seller_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Store::store.form.seller'),
                'options' => \App\Entities\User::where('role_id',2)->get(['id',"name as title"]),
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
            'title_ar' => [
                'label' => trans('Category::category.form.name_ar'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'title_ar',
                'anchor-class' => 'editable',
            ],
            'title_en' => [
                'label' => trans('Category::category.form.name_en'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'title_en',
                'anchor-class' => 'editable',
            ],
            'seller_name' => [
                'label' => trans('Store::store.form.seller'),
                'type' => '',
                'className' => '',
                'data-col' => 'seller_id',
                'anchor-class' => '',
            ],
            'state_name' => [
                'label' => trans('Store::store.form.state'),
                'type' => '',
                'className' => '',
                'data-col' => 'state_id',
                'anchor-class' => '',
            ],
            'city_name' => [
                'label' => trans('Store::store.form.city'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
            'country_name' => [
                'label' => trans('Store::store.form.country'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
            'status' => [
                'label' => trans('Section::section.form.status'),
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
                'toggleData' => $this->toggleData(),
                'searchData' => $this->searchData(),
                'tableData' => $this->tableData(),
                'modelData' => $this->addData(),
            ];
        }
        return $data;
    }
}
