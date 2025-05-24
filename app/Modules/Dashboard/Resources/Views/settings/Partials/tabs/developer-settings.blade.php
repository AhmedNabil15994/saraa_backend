@php
    $recepients = isset($data['recepients']) && !empty($data['recepients']) ? $data['recepients'] : [['value'=>'']];
@endphp

<div class="form-group p-0 m-0 mb-5">
    <label class="col-form-label">{{ trans('Dashboard::dashboard.setting.enable_emails') }} :</label>
    <div class="col-12 p-0">
        <span class="switch switch-icon">
            <label>
                <input type="checkbox" value="1" name="enable_emails" {{ !isset($data['enable_emails']) ? (old('enable_emails') == 1 ? 'checked' : '') : ($data['enable_emails'] == 1 ? 'checked' : '') }}/>
                <span></span>
            </label>
        </span>
    </div>
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.sender_email') }} :</label>
    <input type="text" class="form-control col-md-8" name="sender_email" value="{{ isset($data['sender_email']) && !empty($data['sender_email']) ? $data['sender_email'] : old('sender_email') }}" placeholder="{{ trans('Dashboard::dashboard.setting.sender_email') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.sender_name') }} :</label>
    <input type="text" class="form-control col-md-8" name="sender_name" value="{{ isset($data['sender_name']) && !empty($data['sender_name']) ? $data['sender_name'] : old('sender_name') }}" placeholder="{{ trans('Dashboard::dashboard.setting.sender_name') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.driver') }} :</label>
    <input type="text" class="form-control col-md-8" name="driver" value="{{ isset($data['driver']) && !empty($data['driver']) ? $data['driver'] : old('driver') }}" placeholder="{{ trans('Dashboard::dashboard.setting.driver') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.host') }} :</label>
    <input type="text" class="form-control col-md-8" name="host" value="{{ isset($data['host']) && !empty($data['host']) ? $data['host'] : old('host') }}" placeholder="{{ trans('Dashboard::dashboard.setting.host') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.port') }} :</label>
    <input type="text" class="form-control col-md-8" name="port" value="{{ isset($data['port']) && !empty($data['port']) ? $data['port'] : old('port') }}" placeholder="{{ trans('Dashboard::dashboard.setting.port') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.encryption') }} :</label>
    <input type="text" class="form-control col-md-8" name="encryption" value="{{ isset($data['encryption']) && !empty($data['encryption']) ? $data['encryption'] : old('encryption') }}" placeholder="{{ trans('Dashboard::dashboard.setting.encryption') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.username') }} :</label>
    <input type="text" class="form-control col-md-8" name="username" value="{{ isset($data['username']) && !empty($data['username']) ? $data['username'] : old('username') }}" placeholder="{{ trans('Dashboard::dashboard.setting.username') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.password') }} :</label>
    <input type="text" class="form-control col-md-8" name="password" value="{{ isset($data['password']) && !empty($data['password']) ? $data['password'] : old('password') }}" placeholder="{{ trans('Dashboard::dashboard.setting.password') }}">
</div>

<div id="kt_repeater_3">
    <div class="form-group p-0 m-0 mb-5">
        <label class="col-lg-3 col-form-label">{{trans('Dashboard::dashboard.recepients')}}:</label>
        <div data-repeater-list="recepients" class="col-lg-6">
            @foreach($recepients as $key => $platform)
            <div data-repeater-item="" class="mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="la la-envelope"></i>
                        </span>
                    </div>
                    <input type="email" name="value" value="{{$platform['value']}}" class="form-control" placeholder="{{trans('Dashboard::dashboard.setting.email')}}">
                    <div class="input-group-append">
                        <a href="javascript:;" data-repeater-delete class="btn font-weight-bold btn-danger btn-icon">
                            <i class="la la-close"></i>
                        </a>
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



<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.limitted_size') }} :</label>
    <input type="text" id="kt_touchspin_1" min="1" class="form-control col-md-8" name="limitted_size" value="{{ isset($data['limitted_size']) && !empty($data['limitted_size']) ? $data['limitted_size'] : old('limitted_size') }}" placeholder="{{ trans('Dashboard::dashboard.setting.limitted_size') }}">
</div>

<div class="form-group p-0 m-0 mb-5">
    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.pagination') }} :</label>
    <input type="text" id="kt_touchspin_2" min="1" class="form-control col-md-8" name="pagination" value="{{ isset($data['pagination']) && !empty($data['pagination']) ? $data['pagination'] : old('pagination') }}" placeholder="{{ trans('Dashboard::dashboard.setting.pagination') }}">
</div>


@push('js')
<script>
    $(function(){
        $('#kt_repeater_3').repeater({
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