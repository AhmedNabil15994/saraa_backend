<div class="form-group p-0 m-0 mb-5 pt-5">
    <label class="col-form-label">{{ trans('Year::year.form.year') }} :</label>
    <input type="text" class="form-control col-md-8" name="title" value="{{ isset($model) ? $model->title : old('title') }}" placeholder="{{ trans('Year::year.form.year') }}">
</div>

<div class="form-group row p-0 m-0 mb-5">
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
