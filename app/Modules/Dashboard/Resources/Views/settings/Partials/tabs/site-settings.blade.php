@include('dashboard.Layouts.crud.localize_inputs')

<div class="tab-content mt-5" id="myTabContent">
    @foreach($available_locales as $key => $lang)
    <div class="tab-pane fade  {{$key == 0? 'active show' : ''}}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.app_name_'.$lang['prefix']) }} :</label>                       
            <input type="text" class="form-control col-md-8" name="app_name_{{$lang['prefix']}}" 
                value="{{ isset($data['app_name_'.$lang['prefix']]) && !empty($data['app_name_'.$lang['prefix']]) ? $data['app_name_'.$lang['prefix']] : old('app_name_'.$lang['prefix']) }}" 
                placeholder="{{ trans('Dashboard::dashboard.setting.app_name_'.$lang['prefix']) }}">
        </div>
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.app_desc_'.$lang['prefix']) }} :</label>                       
            <textarea  class="form-control col-md-8" name="app_desc_{{$lang['prefix']}}" placeholder="{{ trans('Dashboard::dashboard.setting.app_desc_'.$lang['prefix']) }}" cols="30" rows="10">{{ isset($data['app_desc_'.$lang['prefix']]) && !empty($data['app_desc_'.$lang['prefix']]) ? $data['app_desc_'.$lang['prefix']] : old('app_desc_'.$lang['prefix']) }}</textarea>
        </div>
    </div>
    @endforeach
</div>