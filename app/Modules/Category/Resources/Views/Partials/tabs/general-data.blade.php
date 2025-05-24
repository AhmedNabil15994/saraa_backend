@include('dashboard.Layouts.crud.localize_inputs')

<div class="tab-content mt-5" id="myTabContent">
    @foreach($available_locales as $key => $lang)
    <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label class="col-form-label">{{ trans('Category::category.form.name_'.$lang['prefix']) }} :</label>
            <input type="text" class="form-control col-md-8" name="name_{{$lang['prefix']}}" value="{{ isset($model) ? $model->{'name_'.$lang['prefix']} : old('name_'.$lang['prefix']) }}" placeholder="{{ trans('Category::category.form.name_'.$lang['prefix']) }}">
        </div>
    </div>
    @endforeach
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="">{{ trans('Category::category.form.parent') }} :</label>
    <select name="parent_id" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>        
        @foreach($parents as $oneCategory)
        <option value="{{$oneCategory->id}}" {{$oneCategory->id == ( isset($model) ? $model->parent_id : old('parent_id') ) ? 'selected' : ''}} >{{ $oneCategory->display_name }}</option>
        @endforeach
    </select>
</div>

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
    <label class="col-form-label">{{trans('Blog::blog.form.image')}}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ isset($model) ? $model->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('Blog::blog.form.change_image_p')}}">
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