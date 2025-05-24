<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;
use App\Transformers\CountryResource;
use App\Entities\Country;

use App\Transformers\CityResource;
use App\Entities\City;

class StateCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('State::state.title'),
            'url' => 'dashboard/'.'states',
            'name' => 'states',
            'nameOne' => 'state',
            'modelName' => 'State',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('State::state.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'country_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('State::state.form.country'),
                'options' =>  CountryResource::collection(Country::active()->get()),
            ],
            'city_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('State::state.form.city'),
                'options' =>  CityResource::collection(City::active()->get()),
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
            'city_name' => [
                'label' => trans('State::state.form.country'),
                'type' => '',
                'className' => '',
                'data-col' => 'city_id',
                'anchor-class' => '',
            ],
            'country_name' => [
                'label' => trans('State::state.form.city'),
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
