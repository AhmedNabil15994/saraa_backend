<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.phone') }} :</label>
    <input type="text" dir="ltr" class="form-control col-md-8" name="phone" value="{{ isset($data['phone']) && !empty($data['phone']) ? $data['phone'] : old('phone') }}" placeholder="{{ trans('Dashboard::dashboard.setting.phone') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.whatsapp') }} :</label>
    <input type="text" dir="ltr" class="form-control col-md-8" name="whatsapp" value="{{ isset($data['whatsapp']) && !empty($data['whatsapp']) ? $data['whatsapp'] : old('whatsapp') }}" placeholder="{{ trans('Dashboard::dashboard.setting.whatsapp') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.email') }} :</label>
    <input type="email" class="form-control col-md-8" name="email" value="{{ isset($data['email']) && !empty($data['email']) ? $data['email'] : old('email') }}" placeholder="{{ trans('Dashboard::dashboard.setting.email') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.location') }} :</label>
    <input type="text" class="form-control col-md-8" name="location" value="{{ isset($data['location']) && !empty($data['location']) ? $data['location'] : old('location') }}" placeholder="{{ trans('Dashboard::dashboard.setting.location') }}">
</div>
