@php
    $urls = isset($data['socials']) && !empty($data['socials']) ? $data['socials'] : [['key'=>'','value'=>'']];
@endphp
<div id="kt_repeater_2">
    <div class="form-group p-0 m-0 mb-5">
        <label class="col-lg-3 col-form-label">{{trans('Dashboard::dashboard.url')}}:</label>
        <div data-repeater-list="socials" class="col-lg-6">
            @foreach($urls as $key => $platform)
            <div data-repeater-item="" class="mb-2">
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="key" class="form-control" value="{{$platform['key']}}" placeholder="{{trans('Dashboard::dashboard.platform_name')}}">
                    </div>
                    <div class="input-group col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-link"></i>
                            </span>
                        </div>
                        <input type="text" name="value" value="{{$platform['value']}}" class="form-control" placeholder="{{trans('Dashboard::dashboard.platform_url')}}">
                        <div class="input-group-append">
                            <a href="javascript:;" data-repeater-delete class="btn font-weight-bold btn-danger btn-icon">
                                <i class="la la-close"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="form-group p-0 m-0 mb-5">
        <div class="col-lg-3"></div>
        <div class="col">
            <div data-repeater-create="" class="btn font-weight-bold btn-warning">
            <i class="la la-plus"></i>{{trans('Dashboard::dashboard.add')}}</div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(function(){
        $('#kt_repeater_2').repeater({
            initEmpty: false,
           
            defaultValues: {
                'text-input': 'foo'
            },
             
            show: function() {
                $(this).slideDown();                               
            },

            hide: function(deleteElement) {                 
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }                                
            }      
        });
    })
</script>
@endpush