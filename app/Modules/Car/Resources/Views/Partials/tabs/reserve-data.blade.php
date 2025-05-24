@php 
    $prices = isset($model) && $model->prices_arr != null ? $model->prices_arr : [(object)['price'=>'','duration'=>'']];
@endphp
<div id="kt_repeater_2">
    <div class="form-group p-0 m-0 mb-5">
        <label class="col-lg-3 col-form-label">{{trans('Car::car.form.prices')}}:</label>
        <div data-repeater-list="prices" class="col-lg-8">
            @foreach($prices as $priceArr)
            <div data-repeater-item="" class="mb-2 priceItem">
                <div class="row">
                    <div class="col-5">
                        <input type="text" data-input="convert" value="{{$priceArr->duration}}" min="{{$priceArr->duration}}" name="duration" class="form-control duration" placeholder="{{ trans('Car::car.form.duration') }}">
                    </div>
                    <div class="input-group col-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-link"></i>
                            </span>
                        </div>
                        <input type="text" data-input="convert" value="{{$priceArr->price}}" min="{{$priceArr->price}}" name="price" class="form-control price" placeholder="{{ trans('Car::car.form.price') }}">
                        <div class="input-group-append">
                            <a href="javascript:;" data-repeater-delete class="btn font-weight-bold btn-danger btn-icon">
                                <i class="la la-close"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-2 priceDetailsInfo">
                        <b class="price-info">
                            @if($priceArr->price)
                            {{ $priceArr->price * $priceArr->duration .' ' . trans('Dashboard::dashboard.currency') .' / '. $priceArr->duration . ' ' . trans('Dashboard::dashboard.days')  }}
                            @endif
                        </b>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="form-group p-0 m-0 mb-5 addPrice ">
        <div class="col-lg-3"></div>
        <div class="col">
            <div class="btn font-weight-bold btn-warning main">
            <i class="la la-plus"></i>{{trans('Dashboard::dashboard.add')}}</div>
        </div>
    </div>
</div>

{{-- <div class="form-group p-0 m-0 mb-5">
    <div class="row col-8">
        <div class="col-6">
            <label for="inputEmail3">{{ trans('Car::car.form.price') }} :</label>
            <input type="text" class="form-control" name="price" value="{{isset($model) ? $model->price : old('price')}}" placeholder="{{ trans('Car::car.form.price') }}">
        </div>
        <div class="col-6">
            <label for="inputEmail3">{{ trans('Car::car.form.duration') }} :</label>
            <input type="text" class="form-control" name="duration" value="{{isset($model) ? $model->duration : old('duration')}}" placeholder="{{ trans('Car::car.form.duration') }}">
        </div>
    </div>
</div>
data-repeater-create=""
 --}}
@push('js')
<script type="text/javascript">
    $(function(){

        let repeaterOptions = {
            initEmpty: false,
            show: function() {
                $(this).find('.priceDetailsInfo').addClass('hidden')
                $(this).slideDown(function(){
                    $(this).find('input[data-input="convert"]').removeAttr('type').attr('type',"number")
                    $('#kt_repeater_2 .duration').each(function(_,el){
                        if($('#kt_repeater_2 .duration')[_ -1]){
                            let item = $('#kt_repeater_2 .duration')[_ -1];
                            $(el).attr('min',parseInt($(item).val())+1);
                        }
                    });
                    $('#kt_repeater_2 .price').each(function(_,el){
                        $(el).attr('min',1);
                    });
                });                               
            },
            hide: function(deleteElement) {                 
                $(this).slideUp(deleteElement);                              
            }      
        };
        
        $('#kt_repeater_2').repeater(repeaterOptions);

        $(document).on('blur','.duration,.price',function(){
            if(!$(this).val()){
                $(this).val($(this).attr('min'))
            }else{
                if(parseInt($(this).val()) < $(this).attr('min')){
                    $(this).val($(this).attr('min'))
                }
            }
            
        })

        $(document).on('blur','.price',function(){
            let price = $(this).val();
            let days = $(this).parent('.input-group').siblings('.col-5').children('input.duration').val()
            $(this).parent('.input-group').siblings('.priceDetailsInfo').removeClass('hidden').children('b.price-info').html( price * days + " {{ trans('Dashboard::dashboard.currency') }}" + " / " + days + " {{ trans('Dashboard::dashboard.days') }}");
        })

        $(document).on('click','.addPrice .btn-warning.main',function(e){
            let prices = $('#kt_repeater_2').repeaterVal().prices;
            let button = $(this);
            let disableFlag = 0;
            if(prices){
                $.each(prices,function(index,item){
                    if(item.price == '' || item.duration == ''){
                        disableFlag+=1;
                    }
                })
                if(!disableFlag){
                    $('#kt_repeater_2').repeater(repeaterOptions);
                    button.attr('data-repeater-create','');
                    button.click()
                }else{
                    button.removeAttr('data-repeater-create',);
                }
            }
        });

        $('form.form button[type="submit"]').on('click',function(e){
            e.preventDefault();
            e.stopPropagation();
            let hasErrors = 0;
            $.each($('.priceItem'),function(index,item){
                if(!$(item).find('.price').val()){
                    hasErrors = 1;
                    errorNotification("{{ trans('Car::car.form.price_error') }}"+ (index+1))
                }
                if(!$(item).find('.duration').val()){
                    hasErrors = 1;
                    errorNotification("{{ trans('Car::car.form.duration_error') }}"+ (index+1))
                }
            })

            if(!hasErrors){
                $('form.form').submit();
            }
        });

        // $('input[name="different_prices"]').on('change',function(){
        //     if($(this).is(':checked')){
        //         $('.addPrice').removeClass('hidden')
        //     }else{
        //         $('.addPrice').addClass('hidden')
        //     }
        // })

    })
</script>
@endpush
{{-- <div class="form-group p-0 m-0 mb-5 pt-5">
    <label class="col-form-label">{{ trans('Car::car.form.available') }} :</label>
    <div class=" col-md-9 col-sm-12">
        <div class="row">
            <div class="col">
                <div class="input-group date" id="kt_datetimepicker_7_1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" placeholder="{{trans('Car::car.form.available_from')}}" data-target="#kt_datetimepicker_7_1" name="available_from" value="{{isset($model) ? date('m/d/Y H:i A',strtotime($model->available_from)) : old('available_from')}}" />
                    <div class="input-group-append" data-target="#kt_datetimepicker_7_1" data-toggle="datetimepicker">
                        <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="input-group date" id="kt_datetimepicker_7_2" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" placeholder="{{trans('Car::car.form.available_to')}}" data-target="#kt_datetimepicker_7_2" name="available_to"  value="{{isset($model) ? date('m/d/Y H:i A',strtotime($model->available_to)) : old('available_to')}}"/>
                    <div class="input-group-append" data-target="#kt_datetimepicker_7_2" data-toggle="datetimepicker">
                        <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}