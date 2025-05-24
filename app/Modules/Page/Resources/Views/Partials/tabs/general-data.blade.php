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