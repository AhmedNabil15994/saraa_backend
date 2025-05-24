<?php

namespace App\Repositories;
use App\Entities\Brand;
use App\Entities\CarModel;
use App\Entities\CarType;
use App\Entities\Color;
use App\Entities\Store;
use App\Interfaces\DesignInterface;
use App\Transformers\BrandResource;
use App\Transformers\CarModelResource;
use App\Transformers\CarTypeResource;
use App\Transformers\ColorResource;
use App\Transformers\StoreResource;

class CarCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('Car::car.title'),
            'url' => 'dashboard/'.'cars',
            'name' => 'cars',
            'nameOne' => 'car',
            'modelName' => 'Car',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('Car::car.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'store_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.store'),
                'options' => StoreResource::collection(Store::active()->get()),
            ],
            'seller_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.seller'),
                'options' => \App\Entities\User::active()->where('role_id',2)->get(['id',"name as title"]),
            ],
            'brand_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.brand'),
                'options' => BrandResource::collection(Brand::active()->get()),
            ],
            'model_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.model'),
                'options' => CarModelResource::collection(CarModel::active()->get()),
            ],
            'year' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Car::car.form.year'),
            ],
            'color' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.color'),
                'options' => ColorResource::collection(Color::active()->get()),
            ],
            'type' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.type'),
                'options' => CarTypeResource::collection(CarType::active()->get()),
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
                'label' => trans('Section::section.form.title_ar'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'name_ar',
                'anchor-class' => 'editable',
            ],
            'title_en' => [
                'label' => trans('Section::section.form.title_en'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'name_en',
                'anchor-class' => 'editable',
            ],
            'store_name' => [
                'label' => trans('Car::car.form.store'),
                'type' => '',
                'className' => '',
                'data-col' => 'store_id',
                'anchor-class' => '',
            ],
            'seller_name' => [
                'label' => trans('Car::car.form.seller'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
            'brand_name' => [
                'label' => trans('Car::car.form.brand'),
                'type' => '',
                'className' => '',
                'data-col' => 'brand_id',
                'anchor-class' => '',
            ],
            'model_name' => [
                'label' => trans('Car::car.form.model'),
                'type' => '',
                'className' => '',
                'data-col' => 'model_id',
                'anchor-class' => '',
            ],
            'year' => [
                'label' => trans('Car::car.form.year'),
                'type' => '',
                'className' => '',
                'data-col' => 'year',
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
