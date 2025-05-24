@include('dashboard.Layouts.crud.localize_inputs')

<div class="tab-content mt-5" id="myTabContent">
    @foreach($available_locales as $key => $lang)
    <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label class="col-form-label">{{ trans('Role::role.form.name_'.$lang['prefix']) }} :</label>
            <input type="text" class="form-control col-md-8" name="name_{{$lang['prefix']}}" value="{{ isset($model) ? $model->{'name_'.$lang['prefix']} : old('name_'.$lang['prefix']) }}" placeholder="{{ trans('Role::role.form.name_'.$lang['prefix']) }}">
        </div>
    </div>
    @endforeach
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label>{{ trans('EmployeeRole::employeeRole.form.creator') }}</label>
    <select name="created_by" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($sellers as $seller)
        <option value="{{$seller->id}}"  {{ $seller->id == (isset($model) ? $model->created_by : old('created_by')) ? 'selected' : '' }}>{{$seller->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group p-0 m-0 mb-5">
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

<div class="form-group row p-0 m-0 mb-5">
    <label>{{ trans('Role::role.form.permissions') }}</label>
    <div class="row">
        @foreach($permissions as $key => $permission)
        @php 
            $module = str_replace('Controller','',$key);
            $text = trans($module.'::'.lcfirst($module).'.title');
            $hasSettings = str_contains($text, '::');
            $rolePerms = isset($model) && $model->permissions != null ? unserialize($model->permissions) : [];
            $currentModPerms = count($permissions[$key]);
            $roleModPerms = 0;
            foreach ($permission as $value) {
                $roleModPerms+= isset($model) && in_array($value['perm_name'], $rolePerms) ? 1 : 0;
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
                                <input type="checkbox" value="{{ $onePerm['perm_name'] }}" name="permissions[]" {{in_array($onePerm['perm_name'],$rolePerms) ? 'checked' : ''}}/>
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