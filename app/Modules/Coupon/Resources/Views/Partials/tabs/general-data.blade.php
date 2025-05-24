<div class="form-group  p-0 m-0 mb-5">
    <label for="inputPassword3">{{  trans('Car::car.form.store') }} :</label>
    <select name="store_id" class="form-control col-md-8" data-toggle="select2">
        <option value="" >{{  trans('Dashboard::dashboard.choose') }}</option>
        @foreach($stores as $store)
        <option value="{{ $store->id }}" {{ $store->id == (isset($model) ? $model->store_id : old('store_id')) ? 'selected' : '' }}>{{ $store->display_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group  p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Coupon::coupon.form.code') }} :</label>
    <input type="text" class="form-control col-md-8" value="{{ isset($model) ? $model->code : old('code') }}" name="code" id="inputEmail3" placeholder="{{ trans('Coupon::coupon.form.code') }}">
</div>
<div class="form-group  p-0 m-0 mb-5">
    <label for="inputPassword3">{{  trans('Coupon::coupon.form.discount_type') }} :</label>
    <select name="discount_type" class="form-control col-md-8" data-toggle="select2">
        <option value="1" {{ (isset($model) ? $model->discount_type : old('discount_type')) == 1 ? 'selected' : '' }}>{{  trans('Coupon::coupon.form.type_1') }}</option>
        <option value="2" {{ (isset($model) ? $model->discount_type : old('discount_type')) == 2 ? 'selected' : '' }}>{{  trans('Coupon::coupon.form.type_2') }}</option>
    </select>
</div>
<div class="form-group  p-0 m-0 mb-5">
    <label for="inputPassword3">{{  trans('Coupon::coupon.form.discount_value') }} :</label>
    <input class="form-control col-md-8" type="text" name="discount_value" value="{{ isset($model) ? $model->discount_value : old('discount_value') }}" maxlength="" placeholder="{{  trans('Coupon::coupon.form.discount_value') }}">
</div>
<div class="form-group  p-0 m-0 mb-5">
    <label for="inputPassword3">{{ trans('Coupon::coupon.form.valid_type') }} :</label>
    <select name="valid_type" class="form-control col-md-8" data-toggle="select2">
        <option value="1" {{ (isset($model) ? $model->valid_type : old('valid_type')) == 1 ? 'selected' : '' }}>{{ trans('Coupon::coupon.form.valid_type_1') }}</option>
        <option value="2" {{ (isset($model) ? $model->valid_type : old('valid_type')) == 2 ? 'selected' : '' }}>{{ trans('Coupon::coupon.form.valid_type_2') }}</option>
    </select>
</div>
<div class="form-group  p-0 m-0 mb-5">
    <label for="inputPassword3">{{  trans('Coupon::coupon.form.valid_until') }} :</label>
    <input class="form-control mb-5 datetimepicker-inputs col-md-8"  type="text" name="valid_until" value="{{ isset($model) ? $model->valid_until : old('valid_until') }}">
</div>
<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Role::role.form.status') }} :</label>
    <div class="col-12 p-0">
        <span class="switch switch-icon">
            <label>
                <input type="checkbox" value="1" name="status" {{ isset($model) ? ($model->status  == 1 ? 'checked' : '') : 'checked' }}/>
                <span></span>
            </label>
        </span>
    </div>
</div>
