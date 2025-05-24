{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',trans("Reservation::reservation.order_details.title"))
@section('pageName',trans("Reservation::reservation.order_details.title"))

@section('breadcrumbs')
@include('dashboard.Layouts.breadcrumb',[
    'breadcrumbs' => [
        [
            'title' => trans('Dashboard::dashboard.menu'),
            'url' => \URL::to('/dashboard')
        ],
        [
            'title' => trans("Reservation::reservation.order_details.title"),
            'url' => URL::current()
        ],
    ],
])
@endsection

@push('css')
<style>
    @media print{
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }
        body {
            padding-top: 5rem;
            background: #FFF;
        }
        .header-fixed.subheader-fixed.subheader-enabled .wrapper{
            padding-top:0;
        }
        .container-fluid{
            padding:0;
        }
        .hidePrint,#kt_quick_user,#kt_header,#kt_subheader,#kt_aside,#kt_header_mobile,#kt_footer{
            display:none !important;
        }
        .mainData{
            display:block !important;
            max-width:100% !important;
            width:100% !important;
            flex:0 0 100% !important;
            padding:0 !important;
            margin:0 !important;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #3f4254;
            background-color: transparent;
        }
        .text-muted{
            color: #333 !important;
        }
        .table thead td, .table thead th,span{
            font-size: 1.25rem;
        }
        .card.card-custom>.card-header{
            border:0;
        }
        .card.card-custom>.card-header .card-title{
            width: 100%;
            display: block;
            text-align: center;
            margin-top:0;
        }
        .card.card-custom>.card-header .card-title .card-label{
            font-weight:bold;
            font-size:3rem;
            color: #333;
        }
        
    }
    
    .bg-secondary .card{
        background-color: #e4e6ef!important;
        padding: 23px 24px;
        border-radius: 6px;
        width: 100%;
        margin: 10px 0px;
    }
    
    .bg-secondary{
        background-color: #292a2d00!important;
    }
</style>
@endpush

@section('content')
<div class="row clearfix">
    <div class="col-md-8 col-xs-12 mainData">
        <div class="card card-custom mb-8">
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">{{ trans("Reservation::reservation.order_details.title") }}
                </div>
            </div>
            <div class="card-body py-4">
                <div class="d-flex justify-content-between py-10 pb-md-20 flex-column flex-md-row">
                    <h1 class="display-4 font-weight-boldest">#{{ $model->id }}</h1>
                    <div class="d-flex flex-column align-items-md-end px-0">
                        <span class="d-flex flex-column align-items-md-end opacity-70">
                            <span class="bg bg-secondary p-2 px-5 font-weight-boldest" style="border-radius: 5px;">{{ trans('Reservation::reservation.order_details.status_'.$model->status) }}</span>
                        </span>
                    </div>
                </div>
                <div class="row p-0 m-0 mb-5">
                    <div class="d-flex col-5 bg-secondary flex-column p-5" style="border-radius: 5px;">
                        <div class="card">

                            <span class="font-weight-bolder mb-5">{{ trans("Reservation::reservation.order_details.delievered_to") }}</span>
                            <span class="opacity-70 mb-2">{{ $model->Store->address }}</span>
                            <span class="opacity-70 mb-2">{{ trans('Store::store.form.lat') }}: {{ $model->lat }}</span>
                            <span class="opacity-70 mb-2">{{ trans('Store::store.form.lng') }}: {{ $model->lng }}</span>
    
    
                        </div>
                        <div class="card">
                            @if($model->address)
                                <span class="font-weight-bolder mb-5">{{ trans("Reservation::reservation.order_details.client_delievered_to") }}</span>
                                @foreach (\App\Modules\Reservation\Enums\ReservationAddressKeys::getConstants() as $const)
                                    @if (isset($model->address[$const]))
                                        <span class="opacity-70 mb-2">{{ trans("Reservation::reservation.order_details.$const") }}: {{ $model->address[$const] }}</span> 
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="d-flex col-5 flex-column bg-secondary align-items-md-end p-5" style="border-radius: 5px;">
                        <div class="card">

                            <span class="font-weight-bolder mb-2">#{{ $model->id }}</span>
                            <span class="font-weight-bolder mb-2">{{ date('d-m-Y h:i A', strtotime($model->created_at)) }}</span>
                            <span class="opacity-70 mb-2">{{ trans('Reservation::reservation.form.client') }}: {{ $model->Client->name }}</span>
                            <span class="opacity-70 mb-2">{{ trans('Employee::employee.form.mobile') }}: {{ $model->Client->mobile }}</span>
                            @if($model->ActivePayment)
                            <span class="opacity-70 mb-2">{{ trans("Reservation::reservation.order_details.payment_type") }}: {{ ucwords($model->ActivePayment->transaction['method']) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.order_items") }}</th>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.store_name") }}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.reservation_from") }}</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.reservation_to") }}</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.amount") }}</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.subtotal") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-boldest">
                                        <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                            <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                <div class="symbol-label" style="background-image: url({{ asset($model->Car->image_url) }})"></div>
                                            </div>
                                            {{ $model->car_name }}
                                        </td>
                                        <td class="pt-7 align-middle">{{ $model->store_name }}</td>
                                        <td class="text-right pt-7 align-middle">{{ date('Y-m-d',strtotime($model->reserve_from)) }}</td>
                                        <td class="text-right pt-7 align-middle">{{ date('Y-m-d',strtotime($model->reserve_to)) }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ number_format($model->price,2) . ' ' . trans('Dashboard::dashboard.currency') }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ number_format($model->price,2) . ' ' . trans('Dashboard::dashboard.currency') }}</td>
                                    </tr>
                                    <tr class="font-weight-boldest">
                                        <td class="pt-7 align-middle" colspan="5">{{ trans("Reservation::reservation.order_details.subtotal") }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ number_format($model->price,2) . ' ' . trans('Dashboard::dashboard.currency') }}</td>
                                    </tr>
                                    <tr class="font-weight-boldest">
                                        <td class="pt-7 align-middle" colspan="5">{{ trans("Reservation::reservation.order_details.discount") }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ ($model->discount_price ? number_format($model->price - $model->discount_price,2) : '0.00'). ' ' . trans('Dashboard::dashboard.currency') }}</td>
                                    </tr>
                                    <tr class="font-weight-boldest">
                                        <td class="pt-7 align-middle" colspan="5">{{ trans("Reservation::reservation.order_details.total") }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ ($model->discount_price ? number_format($model->discount_price,2) : number_format($model->price,2)). ' ' . trans('Dashboard::dashboard.currency') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <div class="row p-0 m-0 mb-5">
                    <div class="d-flex flex-column p-5" style="border-radius: 5px;">
                        <span class="font-weight-bolder mb-5">{{ trans("Reservation::reservation.order_details.notes") }}:</span>
                        <span class="opacity-70 mb-2">{{ $model->notes }}</span>
                    </div>
                </div>
            </div>
        </div>
        @if(count($model->payments))
        <div class="card card-custom mb-8 mainData">
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">{{ trans("Reservation::reservation.order_details.transactions") }}
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center pr-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.transaction_id") }}</th>
                                        <th class="text-center pl-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.payment_id") }}</th>
                                        <th class="text-center pl-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.track_id") }}</th>
                                        <th class="text-center pr-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.reference_id") }}</th>
                                        <th class="text-center font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.payment_type") }}</th>
                                        <th class="text-center font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.payment_result") }}</th>
                                        <th class="text-center pr-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.date") }}</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{ trans("Reservation::reservation.order_details.total_paid") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($model->payments as $transaction)
                                    <tr class="font-weight-boldest">
                                        <td class="text-right align-middle">{{ $transaction->transaction ? $transaction->transaction['TranID'] : ''}}</td>
                                        <td class="text-right align-middle">{{ $transaction->transaction ? $transaction->transaction['PaymentID'] : ''}}</td>
                                        <td class="text-right align-middle">{{ $transaction->transaction ? $transaction->transaction['TrackID'] : ''}}</td>
                                        <td class="text-right align-middle">{{ $transaction->transaction ? $transaction->transaction['Ref'] : ''}}</td>
                                        <td class="text-right align-middle">{{ $transaction->transaction ? ucwords($transaction->transaction['method']) : ''}}</td>
                                        <td class="text-right align-middle">{{ $transaction->transaction ? $transaction->transaction['Result'] : ucwords($transaction->status)}}</td>
                                        <td class="text-primary text-right align-middle">{{ date('d-m-Y h:i A', strtotime($transaction->created_at)) }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle">{{ number_format($transaction->total,2) . ' ' . trans('Dashboard::dashboard.currency') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-4 col-xs-12 hidePrint">
        <div class="card card-custom mb-8">
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">{{ trans("Dashboard::dashboard.actions") }}
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-success mr-2 btn-md px-5" onclick="window.print();">
                        <i class="la la-print"></i>
                        {{trans('Dashboard::dashboard.print')}}
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <form method="POST" action="{{ URL::to('/dashboard/reservations/update',['id' => $model->id]) }}">
                    @csrf
                    <div class="form-group row mb-5">
                        <label class="col-4 col-form-label">{{ trans("Reservation::reservation.order_details.payment_status") }}:</label>
                        <div class="col-8">
                            <select name="status" class="form-control" data-toggle="select2">
                                <option value="">{{ trans('Dashboard::dashboard.choose') }}</option>
                                @foreach(\App\Modules\Reservation\Enums\ReservationStatus::statuses()->getValue() as $status)
                                <option value="{{ $status['id'] }}" {{ $model->status == $status['id'] ? 'selected' : '' }}>{{ trans('Reservation::reservation.order_details.status_'.$status['id']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <label class="col-4 col-form-label">{{ trans("Reservation::reservation.order_details.notes") }}:</label>
                        <div class="col-8">
                            <textarea name="notes" cols="30" rows="10" class="form-control">{{ $model->notes }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right mt-10 mx-5">
                        <button type="submit" class="btn btn-primary mr-2 btn-md px-5">
                            <i class="la la-edit"></i>
                            {{trans('Dashboard::dashboard.edit')}}
                        </button>
                        <a href="{{ URL::to('/dashboard/reservations') }}" class="btn btn-secondary btn-md px-5">
                            <i class="la la-redo"></i>
                            {{trans('Dashboard::dashboard.back')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-custom mb-8">
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">{{ trans("Reservation::reservation.order_details.store") }}
                    <span class="d-block text-muted pt-2 font-size-sm">{{ trans("Reservation::reservation.order_details.store_preview") }}</span></h3>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.name') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->store_name }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Store::store.form.seller') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Store->seller_name }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Store::store.form.state') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Store->state_name }}</span>
                    </div>
                </div>
                @if($model->Store->contact_info && isset($model->Store->contact_info['phone']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.mobile') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder dir-ltr">{{ $model->Store->contact_info['phone'] }}</span>
                    </div>
                </div>
                @endif
                @if($model->Store->contact_info && isset($model->Store->contact_info['email']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.email') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">
                            <a href="#">{{ $model->Store->contact_info['email'] }}</a>
                        </span>
                    </div>
                </div>
                @endif
                @if($model->Store->contact_info && isset($model->Store->contact_info['facebook']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.facebook') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">
                            <a href="#">{{ $model->Store->contact_info['facebook'] }}</a>
                        </span>
                    </div>
                </div>
                @endif
                @if($model->Store->contact_info && isset($model->Store->contact_info['twitter']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.twitter') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">
                            <a href="#">{{ $model->Store->contact_info['twitter'] }}</a>
                        </span>
                    </div>
                </div>
                @endif
                @if($model->Store->contact_info && isset($model->Store->contact_info['instagram']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.instagram') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">
                            <a href="#">{{ $model->Store->contact_info['instagram'] }}</a>
                        </span>
                    </div>
                </div>
                @endif
                @if($model->Store->contact_info && isset($model->Store->contact_info['whatsapp']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.whatsapp') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">
                            <a href="#">{{ $model->Store->contact_info['whatsapp'] }}</a>
                        </span>
                    </div>
                </div>
                @endif
                @if($model->Store->contact_info && isset($model->Store->contact_info['mobile']))
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.mobile') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder dir-ltr">{{ $model->Store->contact_info['mobile'] }}</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="card card-custom mb-8">
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">{{ trans("Reservation::reservation.order_details.car") }}
                    <span class="d-block text-muted pt-2 font-size-sm">{{ trans("Reservation::reservation.order_details.car_preview") }}</span></h3>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Employee::employee.form.name') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Car->title }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Car::car.form.color') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Car->Color->title }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Car::car.form.type') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Car->CarType->title }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Car::car.form.brand') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Car->Brand->title }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Car::car.form.model') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Car->CarModel->title }}</span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">{{ trans('Car::car.form.year') }}:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder">{{ $model->Car->year }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom mb-8">
            <div class="card-header h-auto py-4">
                <div class="card-title">
                    <h3 class="card-label">{{ trans("Reservation::reservation.order_details.map_location") }}
                    <span class="d-block text-muted pt-2 font-size-sm">{{ trans("Reservation::reservation.order_details.map_location_preview") }}</span></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="map-frame rounded overflow-hidden">
                    <iframe src = "https://maps.google.com/maps?q={{$model->lat}},{{$model->lng}}&hl=es;z=10&amp;output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/reservations.js')}}"></script>
@endpush