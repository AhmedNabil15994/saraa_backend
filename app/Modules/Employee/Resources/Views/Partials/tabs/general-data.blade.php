<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Seller::seller.form.name') }} :</label>
    <input type="text" class="form-control col-md-8" name="name" value="{{isset($model) ? $model->name : old('name')}}" placeholder="{{ trans('Seller::seller.form.name') }}">
</div>
<div class="form-group p-0 m-0 mb-5 col-md-8">
    <label for="inputEmail3">{{ trans('Seller::seller.form.mobile') }} :</label>
    <input type="hidden" name="calling_code" value="{{isset($model) ? $model->calling_code : old('calling_code')}}">
    <input type="text" class="form-control" name="mobile" id="mobile" value="{{isset($model) ? $model->mobile : old('mobile')}}" placeholder="{{ trans('Seller::seller.form.mobile') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Seller::seller.form.email') }} :</label>
    <input type="email" class="form-control col-md-8" name="email" value="{{isset($model) ? $model->email : old('email')}}" placeholder="{{ trans('Seller::seller.form.email') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Seller::seller.form.password') }} :</label>
    <input type="password" class="form-control col-md-8" name="password" placeholder="{{ trans('Seller::seller.form.password') }}" readonly onfocus="this.removeAttribute('readonly');">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Seller::seller.form.password_confirmation') }} :</label>
    <input type="password" class="form-control col-md-8" name="password_confirmation" placeholder="{{ trans('Seller::seller.form.password_confirmation') }}" readonly onfocus="this.removeAttribute('readonly');">
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="">{{ trans('Employee::employee.form.stores') }} :</label>
    <select name="store_id[]" class="form-control col-md-8" multiple data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @php
            $empStores = isset($model) ? $model->EmployeeStores()->pluck('store_id') : [];
            $empStores = isset($model) ? reset($empStores) : [];
        @endphp

        @foreach($stores as $store)
        <option value="{{$store->id}}" {{in_array($store->id, $empStores) ? 'selected' : ''}} >{{$store->display_name}}</option>
        @endforeach
    </select>
</div>
{{-- {{ $store->id == (isset($model) ? $model->country_id : old('country_id')) ? 'selected' : '' }} --}}

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Category::category.form.status') }} :</label>
    <div class="col-12 p-0">
        <span class="switch switch-icon">
            <label>
                <input type="checkbox" value="1" name="status" {{ isset($model) ? ($model->status  == 1 ? 'checked' : '') : 'checked' }}/>
                <span></span>
            </label>
        </span>
    </div>
</div>

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('User::user.form.is_verified') }} :</label>
    <div class="col-12 p-0">
        <span class="switch switch-icon">
            <label>
                <input type="checkbox" value="1" name="is_verified" {{ isset($model) ? ($model->is_verified  == 1 ? 'checked' : '') : 'checked' }}/>
                <span></span>
            </label>
        </span>
    </div>
</div>

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{trans('Employee::employee.form.image')}}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ isset($model) ? $model->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('Employee::employee.form.change_image_p')}}">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="image"/>
                <input type="hidden" name="image_remove"/>
            </label>

            @if(isset($model) && $model->image_url != '')
            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                    <a href="{{ $model->image_url }}" itemprop="contentUrl" data-size="555x370"><i class="fa fa-search"></i></a>
                    <img src="{{ $model->image_url }}" itemprop="thumbnail" style="display: none;">
                </figure>
            </div>
            @endif

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
        </div>
    </div>
</div>