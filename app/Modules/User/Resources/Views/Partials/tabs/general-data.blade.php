@php
    
@endphp
<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.name') }} :</label>
    <input type="text" class="form-control col-md-8" name="name" value="{{isset($model) ? $model->name : old('name')}}" placeholder="{{ trans('User::user.form.name') }}">
</div>
<div class="form-group p-0 m-0 mb-5 col-md-8">
    <label for="inputEmail3">{{ trans('User::user.form.mobile') }} :</label>
    <input type="hidden" name="calling_code" value="{{isset($model) ? $model->calling_code : old('calling_code')}}">
    <input type="text" class="form-control" name="mobile" id="mobile" value="{{isset($model) ? $model->mobile : old('mobile')}}" placeholder="{{ trans('User::user.form.mobile') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.email') }} :</label>
    <input type="email" class="form-control col-md-8" name="email" value="{{isset($model) ? $model->email : old('email')}}" placeholder="{{ trans('User::user.form.email') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.password') }} :</label>
    <input type="password" class="form-control col-md-8" name="password" placeholder="{{ trans('User::user.form.password') }}" readonly
     onfocus="this.removeAttribute('readonly');">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.password_confirmation') }} :</label>
    <input type="password" class="form-control col-md-8" name="password_confirmation" placeholder="{{ trans('User::user.form.password_confirmation') }}" readonly onfocus="this.removeAttribute('readonly');">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('User::user.form.role') }} :</label>
    <select name="role_id" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($roles as $role)
        <option value="{{$role->id}}" {{$role->id == (isset($model) ? $model->role_id : old('role_id')) ? 'selected' : ''}} >{{$role->display_name}}</option>
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
    <label class="col-form-label">{{trans('User::user.form.image')}}</label>
    <div class="col-12 p-0">
        <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ isset($model) ? $model->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
            <div class="image-input-wrapper"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
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

<div class="form-group row p-0 m-0 mt-5">
    <label>{{ trans('User::user.form.extra_permissions') }}</label>
    <div class="row">
        @foreach($permissions as $key => $permission)
        @php 
            $module = str_replace('Controller','',$key);
            $text = trans($module.'::'.lcfirst($module).'.title');
            $hasSettings = str_contains($text, '::');
            $modelPerms = isset($model) && $model->extra_permissions != null ? unserialize($model->extra_permissions) : [];
            $currentModPerms = count($permissions[$key]);
            $roleModPerms = 0;
            foreach ($permission as $value) {
                $roleModPerms+= isset($model) && in_array($value['perm_name'], $modelPerms) ? 1 : 0;
            }
        @endphp 
        <div class="col-4">
            <div class="card card-custom card-collapsed mb-5" data-card="true" id="kt_card_{{$module}}">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{ $hasSettings ? explode('::',$text)[0] : $text }} <small>({{$currentModPerms}})</small></h3>
                    </div>
                    <div class="card-toolbar">
                        <span class="switch switch-sm switch-icon mx-2">
                            <label>
                                <input type="checkbox" value="1" name="modulePerms" {{$roleModPerms == $currentModPerms ? 'checked' : ''}} />
                                <span></span>
                            </label>
                        </span>
                        <a href="#kt_card_{{$module}}" class="btn btn-icon btn-xs btn-light-primary mr-1" data-card-tool="toggle">
                            <i class="ki ki-arrow-up icon-nm"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($permission as $one => $onePerm)
                    @php 
                        $perm = '';
                        $permArr = explode('.', $onePerm['perm_title']); 
                        if(isset($permArr) && isset($permArr[1])){
                            $perm = $hasSettings ? ucwords(str_replace('-',' ',$permArr[1])) : ucwords(explode('-',$permArr[1])[0]);
                        }
                    @endphp 
                    <div class="d-flex flex-row flex-grow-1 font-weight-bold pt-2">
                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg w-75">{{ $perm }}</a>
                        <span class="switch switch-sm switch-icon d-block w-25 text-right">
                            <label>
                                <input type="checkbox" value="{{ $onePerm['perm_name'] }}" name="extra_permissions[]" {{in_array($onePerm['perm_name'],$modelPerms) ? 'checked' : ''}}/>
                                <span></span>
                            </label>
                        </span>
                    </div>
                    <div class="separator separator-dashed separator-border-2 separator-default"></div>

                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('js')
<script>
    $(function(){
        $('input[name="modulePerms"]').on('change',function(){
            let selection = false;
            if($(this).is(":checked")){
                selection = true;
            }
            $(this).parents('.card-header').siblings('.card-body').find('input[type="checkbox"]').prop('checked',selection);
        });
    });
</script>
@endpush