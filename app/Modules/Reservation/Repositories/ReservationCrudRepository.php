<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

use App\Entities\Store;
use App\Transformers\StoreResource;
use App\Entities\State;
use App\Transformers\StateResource;
use App\Entities\Brand;
use App\Transformers\BrandResource;
use App\Entities\CarModel;
use App\Transformers\CarModelResource;
use App\Entities\Car;
use App\Transformers\CarResource;

class ReservationCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('Reservation::reservation.title'),
            'url' => 'dashboard/'.'reservations',
            'name' => 'reservations',
            'nameOne' => 'reservation',
            'modelName' => 'Reservation',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('Reservation::reservation.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'date' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Car::car.form.available'),
            ],
            'seller_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.seller'),
                'options' => \App\Entities\User::active()->where('role_id',2)->get(['id',"name as title"]),
            ],
            'store_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Car::car.form.store'),
                'options' => StoreResource::collection(Store::active()->get()),
            ],
            'state_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Store::store.form.state'),
                'options' => StateResource::collection(State::active()->get()),
            ],
            'client_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Reservation::reservation.form.client'),
                'options' => \App\Entities\User::active()->where('role_id',3)->get(['id',"name as title"]),
            ],
            'car_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Reservation::reservation.form.car'),
                'options' => CarResource::collection(Car::active()->get()),
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
            'transaction_id' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Reservation::reservation.form.transaction_id'),
            ],
            'price' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Reservation::reservation.form.price'),
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function toggleData(): array
    {
        return  [
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
            'client_name' => [
                'label' => trans('Reservation::reservation.form.client'),
                'type' => '',
                'className' => '',
                'data-col' => 'client_id',
                'anchor-class' => '',
            ],
            'car_name' => [
                'label' => trans('Reservation::reservation.form.car'),
                'type' => '',
                'className' => '',
                'data-col' => 'car_id',
                'anchor-class' => '',
            ],
            'reserve_from' => [
                'label' => trans('Reservation::reservation.form.reserve_from'),
                'type' => '',
                'className' => '',
                'data-col' => 'reserve_from',
                'anchor-class' => '',
            ],
            'reserve_to' => [
                'label' => trans('Reservation::reservation.form.reserve_to'),
                'type' => '',
                'className' => '',
                'data-col' => 'reserve_to',
                'anchor-class' => '',
            ],
            'price' => [
                'label' => trans('Reservation::reservation.form.price'),
                'type' => '',
                'className' => '',
                'data-col' => 'price',
                'anchor-class' => '',
            ],
            'transaction_id' => [
                'label' => trans('Reservation::reservation.form.transaction_id'),
                'type' => '',
                'className' => '',
                'data-col' => 'transaction_id',
                'anchor-class' => '',
            ],
            'statusText' => [
                'label' => trans('Section::section.form.status'),
                'type' => '',
                'className' => '',
                'data-col' => 'statusText',
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
