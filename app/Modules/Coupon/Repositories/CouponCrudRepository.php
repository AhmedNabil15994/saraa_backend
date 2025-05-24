<?php

namespace App\Repositories;
use App\Entities\Store;
use App\Interfaces\DesignInterface;
use App\Transformers\StoreResource;

class CouponCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('Coupon::coupon.title'),
            'url' => 'dashboard/'.'coupons',
            'name' => 'coupons',
            'nameOne' => 'coupon',
            'modelName' => 'Coupon',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('Coupon::coupon.newOne'),
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
                'options' =>  StoreResource::collection(Store::active()->get()),
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
            'code' => [
                'label' => trans('Coupon::coupon.form.code'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'code',
                'anchor-class' => 'editable',
            ],
            'discount_type_text' => [
                'label' => trans('Coupon::coupon.form.discount_type'),
                'type' => '',
                'className' => '',
                'data-col' => 'discount_type',
                'anchor-class' => '',
            ],
            'discount_value' => [
                'label' => trans('Coupon::coupon.form.discount_value'),
                'type' => '',
                'className' => '',
                'data-col' => 'discount_value',
                'anchor-class' => '',
            ],
            'valid_until' => [
                'label' => trans('Coupon::coupon.form.valid_until'),
                'type' => '',
                'className' => '',
                'data-col' => 'valid_until',
                'anchor-class' => '',
            ],
            'store_name' => [
                'label' => trans('Car::car.form.store'),
                'type' => '',
                'className' => '',
                'data-col' => 'store_id',
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
