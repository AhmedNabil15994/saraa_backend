@include('dashboard.Layouts.crud.localize_inputs')
<div class="tab-content mt-5" id="myTabContent">
    @foreach($available_locales as $key => $lang)
    <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label class="col-form-label">{{ trans('Blog::blog.form.title_'.$lang['prefix']) }} :</label>
            <input type="text" class="form-control col-md-8" name="title_{{$lang['prefix']}}" value="{{ isset($model) ? $model->{'title_'.$lang['prefix']} : old('title_'.$lang['prefix']) }}" placeholder="{{ trans('Blog::blog.form.title_'.$lang['prefix']) }}">
        </div>
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label class="col-form-label">{{ trans('Blog::blog.form.description_'.$lang['prefix']) }} :</label>
            <textarea  class="form-control col-md-8 ckeditor5" name="description_{{$lang['prefix']}}" placeholder="{{ trans('Blog::blog.form.description_'.$lang['prefix']) }}" cols="30" rows="10">{{ isset($model) ? $model->{'description_'.$lang['prefix']} : old('description_'.$lang['prefix']) }}</textarea>
        </div>
    </div>
    @endforeach
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Blog::blog.form.date') }} :</label>
    <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
        <input type="text" name="date" value="{{ isset($model) ? date('m/d/Y H:i A',strtotime($model->date)) : old('date') }}" class="form-control col-md-8 datetimepicker-input" placeholder="{{ trans('Blog::blog.form.date') }}" data-target="#kt_datetimepicker_1"/>
        <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
            <span class="input-group-text">
                <i class="ki ki-calendar"></i>
            </span>
        </div>
    </div>
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="">{{ trans('Blog::blog.form.category') }} :</label>
    <select name="category_id" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($category_select_tree as $category)
        @include('Blog::Partials.category-select-tree', [
            'oneCategory' => $category,
        ])
        @endforeach
    </select>
</div>

<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Blog::blog.form.status') }} :</label>
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