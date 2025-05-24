@php
    $daysArr = ['sat','sun','mon','tues','wed','thur','fri'];
    $old_work_from = old('work_from') ? old('work_from') : '';
    $old_work_to = old('work_to') ? old('work_to') : '';
@endphp

@foreach($daysArr as $day)
<div class="form-group row p-0 m-0 pt-5 dayItem">
    <label class="w-50px">{{ trans('Store::store.form.'.$day) }} :</label>
    <div class="p-0 mx-5 switch-parent">
        <span class="switch switch-icon switch-sm">
            <label>
                <input type="checkbox" value="1" class="dayToggle" 
                    {{ isset($model) && isset($model->work_from_arr[$day]) && $model->work_from_arr[$day] ? 'checked' : ($old_work_from != '' && $old_work_from[$day] ? 'checked' : '') }} />
                <span></span>
            </label>
        </span>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-12 work_days 
        {{ isset($model) && isset($model->work_from_arr[$day]) && $model->work_from_arr[$day] ? '' : (($old_work_from != '' && $old_work_from[$day] ? '' : 'hidden')) }} ">
        <div class="row">
            <div class="col">
                <div class="input-group date" id="kt_datetimepicker_{{ $day }}_1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input work_from" placeholder="{{trans('Store::store.form.from')}}" data-target="#kt_datetimepicker_{{ $day }}_1" name="work_from[{{ $day }}]" value="{{isset($model) && isset($model->work_from_arr[$day]) ? $model->work_from_arr[$day] : ($old_work_from != '' ? $old_work_from[$day] : '')}}" />
                    <div class="input-group-append" data-target="#kt_datetimepicker_{{ $day }}_1" data-toggle="datetimepicker">
                        <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="input-group date" id="kt_datetimepicker_{{ $day }}_2" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input work_to" placeholder="{{trans('Store::store.form.to')}}" data-target="#kt_datetimepicker_{{ $day }}_2" name="work_to[{{ $day }}]"  value="{{isset($model) && isset($model->work_to_arr[$day]) ? $model->work_to_arr[$day] : ($old_work_to != '' ? $old_work_to[$day] : '')}}"/>
                    <div class="input-group-append" data-target="#kt_datetimepicker_{{ $day }}_2" data-toggle="datetimepicker">
                        <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- <div class="form-group p-0 m-0 mb-5 pt-5">
    <label class="col-form-label">{{ trans('Store::store.form.off_days') }} :</label>
    <select name="off_days[]" multiple class="form-control col-md-8" data-toggle="select2">
        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
        <option value="sat" {{ isset($model) ? (in_array('sat', $model->off_days_arr) ? 'selected' : '') :  '' }}>{{trans('Store::store.form.sat')}}</option>
        <option value="sun" {{ isset($model) ? (in_array('sun', $model->off_days_arr) ? 'selected' : '') :  '' }}>{{trans('Store::store.form.sun')}}</option>
        <option value="mon" {{ isset($model) ? (in_array('mon', $model->off_days_arr) ? 'selected' : '') :  '' }}>{{trans('Store::store.form.mon')}}</option>
        <option value="tues" {{ isset($model) ? (in_array('tues', $model->off_days_arr) ? 'selected' : '') : '' }}>{{trans('Store::store.form.tues')}}</option>
        <option value="wed" {{ isset($model) ? (in_array('wed', $model->off_days_arr) ? 'selected' : '') :  '' }}>{{trans('Store::store.form.wed')}}</option>
        <option value="thur" {{ isset($model) ? (in_array('thur', $model->off_days_arr) ? 'selected' : '') :  '' }}>{{trans('Store::store.form.thur')}}</option>
        <option value="fri" {{ isset($model) ? (in_array('fri', $model->off_days_arr) ? 'selected' : '') : '' }}>{{trans('Store::store.form.fri')}}</option>
    </select>
</div> --}}

@section('scripts')
<script>
    $(function(){
        @foreach($daysArr as $day)
        $('#kt_datetimepicker_{{ $day }}_1').datetimepicker({
            format: 'LT'
        });
        $('#kt_datetimepicker_{{ $day }}_2').datetimepicker({
            format: 'LT',
            useCurrent: false
        });
        $('#kt_datetimepicker_{{ $day }}_1').on('change.datetimepicker', function(e) {
            $('#kt_datetimepicker_{{ $day }}_2').datetimepicker('minDate', e.date);
        });
        $('#kt_datetimepicker_{{ $day }}_2').on('change.datetimepicker', function(e) {
            $('#kt_datetimepicker_{{ $day }}_1').datetimepicker('maxDate', e.date);
        });
        @endforeach

        $('form.form button[type="submit"]').on('click',function(e){
            e.preventDefault();
            e.stopPropagation();
            let daysArr = [
                '{{trans('Store::store.form.sat')}}','{{trans('Store::store.form.sun')}}','{{trans('Store::store.form.mon')}}',
                '{{trans('Store::store.form.tues')}}','{{trans('Store::store.form.wed')}}','{{trans('Store::store.form.thur')}}',
                '{{trans('Store::store.form.fri')}}'
            ];
            let hasErrors = 0;
            $.each($('.dayItem'),function(index,item){
                if($(item).find('.dayToggle').is(':checked')){
                    if(!$(item).find('.work_from').val()){
                        hasErrors = 1;
                        errorNotification("{{ trans('Store::store.form.work_from_error') }}"+ daysArr[index])
                    }
                    if(!$(item).find('.work_to').val()){
                        hasErrors = 1;
                        errorNotification("{{ trans('Store::store.form.work_to_error') }}"+ daysArr[index])
                    }
                }
            })

            if(!hasErrors){
                $('form.form').submit();
            }
        });
    });
</script>
@endsection