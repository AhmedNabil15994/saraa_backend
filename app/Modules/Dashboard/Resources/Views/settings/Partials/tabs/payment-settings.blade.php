<ul class="nav nav-tabs nav-primary nav-tabs-space-lg nav-tabs-bold" role="tablist">
    <li class="nav-item mx-2">
        <a class="nav-link active" id="payment-tab-1" data-toggle="tab" href="#payment-1">
            <span class="nav-icon text-white">
                <i class="la la-credit-card icon-xl"></i>
            </span>
            <span class="nav-text"> UPayment</span>
        </a>
    </li>
</ul>
<div class="tab-content mt-5" id="PaymentTabContent">
    <div class="tab-pane fade active show" id="payment-1" role="tabpanel" aria-labelledby="payment-tab-1">
        <div class="form-group">
            <h3 class="text-center my-10">UPayment Gateaway</h3>
            <div class="radio-inline">
                <label class="radio">
                    <input type="radio" value="test" {{ isset($data['upayment']['mode']) ? ($data['upayment']['mode'] == 'test' ? 'checked' : '') : 'checked' }} name="upayment[mode]"/>
                    <span></span>
                    Test Mode
                </label>
                <label class="radio">
                    <input type="radio" value="live" name="upayment[mode]" {{ isset($data['upayment']['mode']) ? ($data['upayment']['mode'] == 'live' ? 'checked' : '') : '' }}/>
                    <span></span>
                    Live Mode
                </label>
            </div>
        </div>

        @php $modes = ['test','live']; @endphp

        @foreach($modes as $mode)
        <div class="{{ $mode }} {{ isset($data['upayment']['mode']) ? ($data['upayment']['mode'] == $mode ? '' : 'hidden') : ($mode == 'test' ? '' : 'hidden') }}">
            <div class="form-group p-0 m-0 mb-5">
                <label for="inputEmail3">Merchant ID :</label>
                <input type="text" class="form-control col-md-8" name="upayment[{{ $mode }}][merchant_id]" value="{{ isset($data['upayment']) && isset($data['upayment'][$mode]) && !empty($data['upayment'][$mode]['merchant_id']) ? $data['upayment'][$mode]['merchant_id'] : old('upayment['.$mode.'][merchant_id]') }}" placeholder="Merchant ID">
            </div>
            <div class="form-group p-0 m-0 mb-5">
                <label for="inputEmail3">API Key :</label>
                <input type="text" class="form-control col-md-8" name="upayment[{{ $mode }}][api_key]" value="{{ isset($data['upayment']) && isset($data['upayment'][$mode]) && !empty($data['upayment'][$mode]['api_key']) ? $data['upayment'][$mode]['api_key'] : old('upayment['.$mode.'][api_key]') }}" placeholder="API Key">
            </div>
            <div class="form-group p-0 m-0 mb-5">
                <label for="inputEmail3">API Username :</label>
                <input type="text" class="form-control col-md-8" name="upayment[{{ $mode }}][api_username]" value="{{ isset($data['upayment']) && isset($data['upayment'][$mode]) && !empty($data['upayment'][$mode]['api_username']) ? $data['upayment'][$mode]['api_username'] : old('upayment['.$mode.'][api_username]') }}" placeholder="API Username">
            </div>
            <div class="form-group p-0 m-0 mb-5">
                <label for="inputEmail3">API Password :</label>
                <input type="text" class="form-control col-md-8" name="upayment[{{ $mode }}][api_password]" value="{{ isset($data['upayment']) && isset($data['upayment'][$mode]) && !empty($data['upayment'][$mode]['api_password']) ? $data['upayment'][$mode]['api_password'] : old('upayment['.$mode.'][api_password]') }}" placeholder="API Password">
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('js')
<script>
    $(function(){
        $('input[name="upayment[mode]"]').on('change',function(){
            let currentMode = $(this).val();
            let prevMode = (currentMode == 'test' ? 'live' : 'test');
            $('.'+prevMode).hide()
            $('.'+currentMode).removeClass('hidden').show()
        });
    });
</script>
@endpush