@php
    $currentTime = (int) date('H');
    $text = '';
    if($currentTime >= 6 && $currentTime <= 11){
        $text = trans('Dashboard::dashboard.morning');
    }else if($currentTime >= 12 && $currentTime <= 17){
        $text = trans('Dashboard::dashboard.afternoon');
    }else if($currentTime >= 18 || $currentTime <= 5){
        $text = trans('Dashboard::dashboard.evening');
    }
@endphp
<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Topbar-->
        <div class="topbar">
            <div class="topbar-item d-xs-inline-block d-sm-inline-block d-lg-none">
                <!--begin::Languages-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        @php
                            $disableOtherLang = 'ar';
                            if(\Session::has('locale') && \Session::get('locale') == 'en'){
                                $disableOtherLang = 'en';
                            }
                        @endphp
                        <div class="btn mr-1 btn-secondary px-5 btn-dropdown mt-1">
                            <span class="navi-text">{{trans('Dashboard::dashboard.'.($disableOtherLang == 'en' ? 'english' : 'arabic') )}}</span>
                        </div>
                    </div>
                    <!--end::Toggle-->
                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Nav-->
                        <ul class="navi navi-hover py-4">
                            @if($disableOtherLang != 'en')
                            <!--begin::Item-->
                            <li class="navi-item">
                                <a href="{{URL::to('/dashboard/changeLang?lang=en')}}" class="navi-link">
                                    <span class="navi-text">{{trans('Dashboard::dashboard.english')}}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endif
                            @if($disableOtherLang != 'ar')
                            <!--begin::Item-->
                            <li class="navi-item active">
                                <a href="{{URL::to('/dashboard/changeLang?lang=ar')}}" class="navi-link">                                   
                                    <span class="navi-text">{{trans('Dashboard::dashboard.arabic')}}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endif
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
            </div>
        </div>
        <!--end::Topbar-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default mt-3">
                <!--begin::Languages-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                        @php
                            $disableOtherLang = 'ar';
                            if(\Session::has('locale') && \Session::get('locale') == 'en'){
                                $disableOtherLang = 'en';
                            }
                        @endphp
                        <div class="btn mr-1 btn-secondary px-5 btn-dropdown mt-1">
                            <span class="navi-text">{{trans('Dashboard::dashboard.'.($disableOtherLang == 'en' ? 'english' : 'arabic') )}}</span>
                        </div>
                    </div>
                    <!--end::Toggle-->
                    <!--begin::Dropdown-->
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Nav-->
                        <ul class="navi navi-hover py-4">
                            @if($disableOtherLang != 'en')
                            <!--begin::Item-->
                            <li class="navi-item">
                                <a href="{{URL::to('/dashboard/changeLang?lang=en')}}" class="navi-link">
                                    <span class="navi-text">{{trans('Dashboard::dashboard.english')}}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endif
                            @if($disableOtherLang != 'ar')
                            <!--begin::Item-->
                            <li class="navi-item active">
                                <a href="{{URL::to('/dashboard/changeLang?lang=ar')}}" class="navi-link">
                                    <span class="navi-text">{{trans('Dashboard::dashboard.arabic')}}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endif
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
                <!--begin::User-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{$text}}</span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ ucwords(NAME) }}</span>
                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                            <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                        </span>
                    </div>
                </div>
                <!--end::User-->
            </div>
            <!--end::Header Menu-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->