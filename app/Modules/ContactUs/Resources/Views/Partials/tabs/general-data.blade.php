<div class="form-group p-0 m-0 mb-5 pt-5">
    <label for="inputEmail3">{{ trans('ContactUs::contactUs.form.name') }} :</label>                     
    <input type="text" class="form-control col-md-8" name="name" value="{{isset($model) ? $model->name :old('name')}}" placeholder="{{ trans('ContactUs::contactUs.form.name') }}">
</div>
<div class="form-group p-0 m-0 mb-5 pt-5">
    <label for="inputEmail3">{{ trans('ContactUs::contactUs.form.email') }} :</label>                     
    <input type="email" class="form-control col-md-8" name="email" value="{{isset($model) ? $model->email :old('email')}}" placeholder="{{ trans('ContactUs::contactUs.form.email') }}">
</div>
<div class="form-group p-0 m-0 mb-5 pt-5">
    <label for="inputEmail3">{{ trans('ContactUs::contactUs.form.phone') }} :</label>                     
    <input type="text" class="form-control col-md-8" name="phone" value="{{isset($model) ? $model->phone :old('phone')}}" placeholder="{{ trans('ContactUs::contactUs.form.phone') }}">
</div>
<div class="form-group p-0 m-0 mb-5 pt-5">
    <label for="inputEmail3">{{ trans('ContactUs::contactUs.form.message') }} :</label>                     
    <textarea  class="form-control col-md-8" name="message" placeholder="{{ trans('ContactUs::contactUs.form.message') }}" cols="30" rows="10">{{ isset($model) ? $model->message :old('message') }}</textarea>
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