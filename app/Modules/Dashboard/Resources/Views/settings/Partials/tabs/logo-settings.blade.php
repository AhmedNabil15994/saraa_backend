<div class="form-group p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Dashboard::dashboard.setting.app_logo') }}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ asset( (isset($data['app_logo']) && !empty($data['app_logo']) ? $data['app_logo'] : 'assets/dashboard/images/logo.png') )  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="app_logo"/>
                <input type="hidden" name="app_logo_remove"/>
            </label>

            @if(isset($data['app_logo']) && !empty($data['app_logo']))
            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                    <a href="{{ $data['app_logo'] }}" itemprop="contentUrl" data-size="555x370"><i class="fa fa-search"></i></a>
                    <img src="{{ $data['app_logo'] }}" itemprop="thumbnail" style="display: none;">
                </figure>
            </div>
            @endif

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
        </div>
    </div>
</div>

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Dashboard::dashboard.setting.app_favicon') }}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-empty image-input-outline" id="kt_image_6" style="background-image: url({{ asset( (isset($data['app_favicon']) && !empty($data['app_favicon']) ? $data['app_favicon'] : 'assets/dashboard/images/logo.png') )  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="app_favicon"/>
                <input type="hidden" name="app_favicon_remove"/>
            </label>

            @if(isset($data['app_favicon']) && !empty($data['app_favicon']))
            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                    <a href="{{ $data['app_favicon'] }}" itemprop="contentUrl" data-size="555x370"><i class="fa fa-search"></i></a>
                    <img src="{{ $data['app_favicon'] }}" itemprop="thumbnail" style="display: none;">
                </figure>
            </div>
            @endif

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
        </div>
    </div>
</div>

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Dashboard::dashboard.setting.default_upload_img') }}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-empty image-input-outline" id="kt_image_7" style="background-image: url({{ asset( (isset($data['default_upload_img']) && !empty($data['default_upload_img']) ? $data['default_upload_img'] : 'assets/dashboard/images/logo.png') )  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="default_upload_img"/>
                <input type="hidden" name="default_upload_remove"/>
            </label>

            @if(isset($data['default_upload_img']) && !empty($data['default_upload_img']))
            <div class="my-gallery" itemscope="" itemtype="" data-pswp-uid="1">
               <figure itemprop="associatedMedia" itemscope="" itemtype="">
                    <a href="{{ $data['default_upload_img'] }}" itemprop="contentUrl" data-size="555x370"><i class="fa fa-search"></i></a>
                    <img src="{{ $data['default_upload_img'] }}" itemprop="thumbnail" style="display: none;">
                </figure>
            </div>
            @endif

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
        </div>
    </div>
</div>