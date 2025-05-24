<div class="form-group col-md-8  p-0 m-0 mb-5">
    <label class="">{{ trans('Car::car.form.color') }} :</label>
    <select name="color" class="form-control" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($colors as $color)
        <option value="{{$color->id}}"  {{ $color->id == (isset($model) ? $model->color : old('color')) ? 'selected' : '' }}>{{$color->display_name}}</option>
        @endforeach
        @if(\Helper::checkRules('add-color'))
        <option value="@">{{trans('Color::color.newOne')}}</option>
        @endif
    </select>
</div>

<div class="form-group col-md-8 p-0 m-0 mb-5">
    <label class="">{{ trans('Car::car.form.type') }} :</label>
    <select name="type" class="form-control" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($carTypes as $type)
        <option value="{{$type->id}}"  {{ $type->id == (isset($model) ? $model->type : old('type')) ? 'selected' : '' }}>{{$type->display_name}}</option>
        @endforeach
        @if(\Helper::checkRules('add-car-type'))
        <option value="@">{{trans('CarType::carType.newOne')}}</option>
        @endif
    </select>
</div>

<div class="form-group col-md-8 p-0 m-0 mb-5">
    <label class="">{{ trans('Car::car.form.brand') }} :</label>
    <select name="brand_id" class="form-control" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($brands as $brand)
        <option value="{{$brand->id}}"  {{ $brand->id == (isset($model) ? $model->brand_id : old('brand_id')) ? 'selected' : '' }}>{{$brand->display_name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-md-8 p-0 m-0 mb-5">
    <label class="">{{ trans('Car::car.form.model') }} :</label>
    <select name="model_id" class="form-control" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @if(isset($model))
        @foreach($carModels as $carModel)
        <option value="{{$carModel->id}}"  {{ $carModel->id == (isset($model) ? $model->model_id : old('model_id')) ? 'selected' : '' }}>{{$carModel->display_name}}</option>
        @endforeach
        @endif
    </select>
</div>

<div class="form-group col-md-8 p-0 m-0 mb-5">
    <label class="">{{ trans('Car::car.form.year') }} :</label>
    <select name="year" class="form-control" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($years as $year)
        <option value="{{$year->id}}"  {{ $year->id == (isset($model) ? $model->year : old('year')) ? 'selected' : '' }}>{{$year->display_name}}</option>
        @endforeach
    </select>
</div>

@section('modals')
@if(\Helper::checkRules('add-color'))
@include('Color::Partials.createModal')
@endif

@if(\Helper::checkRules('add-car-type'))
@include('CarType::Partials.createModal')
@endif
@endsection

