<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.name') }} :</label>
    <input type="text" class="form-control col-md-8" name="name" value="{{isset($user) ? $user->name : old('name')}}" placeholder="{{ trans('User::user.form.name') }}">
</div>
<div class="form-group p-0 m-0 mb-5 col-md-8">
    <label for="inputEmail3">{{ trans('User::user.form.mobile') }} :</label>
    <input type="text" class="form-control" name="mobile" id="mobile" value="{{isset($user) ? $user->mobile : old('mobile')}}" placeholder="{{ trans('User::user.form.mobile') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.email') }} :</label>
    <input type="email" class="form-control col-md-8" name="email" value="{{isset($user) ? $user->email : old('email')}}" placeholder="{{ trans('User::user.form.email') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.password') }} :</label>
    <input type="password" class="form-control col-md-8" name="password" placeholder="{{ trans('User::user.form.password') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.password_confirmation') }} :</label>
    <input type="password" class="form-control col-md-8" name="password_confirmation" placeholder="{{ trans('User::user.form.password_confirmation') }}">
</div>

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{trans('User::user.form.image')}}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ isset($user) ? $user->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="image"/>
                <input type="hidden" name="image_remove"/>
            </label>

            @if(isset($user) && $user->image_url != '')
            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                    <a href="{{ $user->image_url }}" itemprop="contentUrl" data-size="555x370"><i class="fa fa-search"></i></a>
                    <img src="{{ $user->image_url }}" itemprop="thumbnail" style="display: none;">
                </figure>
            </div>
            @endif

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
        </div>
    </div>
</div>