<ul class="nav nav-tabs nav-primary nav-tabs-space-lg nav-tabs-bold" role="tablist">
    @foreach($available_locales as $key => $lang)
    <li class="nav-item mx-2">
        <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="home-tabs-{{$key+1}}" data-toggle="tab" href="#homes-{{$key+1}}">
            <span class="nav-icon text-white">
                <i class="la la-language icon-xl"></i>
            </span>
            <span class="nav-text"> {{trans('Dashboard::dashboard.'.$lang['name'])}}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content mt-5" id="myTabContents">
    @foreach($available_locales as $key => $lang)
    <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="homes-{{$key+1}}" role="tabpanel" aria-labelledby="home-tabs-{{$key+1}}">
        <div class="form-group p-0 m-0 mb-5 pt-5">
            <label class="col-form-label">{{ trans('Store::store.form.address_'.$lang['prefix']) }} :</label>
            <input type="text" class="form-control col-md-8" name="address_{{$lang['prefix']}}" value="{{ isset($model) ? $model->{'address_'.$lang['prefix']} : old('address_'.$lang['prefix']) }}" placeholder="{{ trans('Store::store.form.address_'.$lang['prefix']) }}">
        </div>
    </div>
    @endforeach
</div>

<div class="form-group p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Store::store.form.lat') }} :</label>
    <input type="text" class="form-control col-md-8" name="lat" value="{{ isset($model) ? $model->lat : old('lat') }}" placeholder="{{ trans('Store::store.form.lat') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Store::store.form.lng') }} :</label>
    <input type="text" class="form-control col-md-8" name="lng" value="{{ isset($model) ? $model->lng : old('lng') }}" placeholder="{{ trans('Store::store.form.lng') }}">
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="">{{ trans('City::city.form.country') }} :</label>
    <select name="country_id" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @foreach($countries as $country)
        <option value="{{$country->id}}"  {{ $country->id == (isset($model) ? $model->State->City->country_id : old('country_id')) ? 'selected' : '' }}>{{$country->display_name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="">{{ trans('State::state.form.city') }} :</label>
    <select name="city_id" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @if(isset($model))
        @foreach($cities as $city)
        <option value="{{$city->id}}"  {{ $city->id == (isset($model) ? $model->State->city_id : old('city_id')) ? 'selected' : '' }}>{{$city->display_name}}</option>
        @endforeach
        @endif
    </select>
</div>

<div class="form-group  p-0 m-0 mb-5">
    <label class="">{{ trans('Store::store.form.state') }} :</label>
    <select name="state_id" class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        @if(isset($model))
        @foreach($states as $state)
        <option value="{{$state->id}}"  {{ $state->id == (isset($model) ? $model->state_id : old('state_id')) ? 'selected' : '' }}>{{$state->display_name}}</option>
        @endforeach
        @endif
    </select>
</div>