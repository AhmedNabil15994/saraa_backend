{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('breadcrumbs')
@include('dashboard.Layouts.breadcrumb',[
    'breadcrumbs' => [
        [
            'title' => trans('Dashboard::dashboard.menu'),
            'url' => \URL::to('/dashboard')
        ],
        [
            'title' => $designElems['mainData']['title'],
            'url' => \URL::current()
        ],
    ]
])
@endsection

@section('content')
<div class="d-flex flex-row">
    @include('Dashboard::settings.Partials.tabs.tabs')
    <div class="flex-row-fluid ml-lg-8">
        <form class="form" method="post" action="{{ URL::current() }}" enctype="multipart/form-data">
            @csrf
            <div class="card card-custom card-stretch">
                <div class="card-body">
                    <div class="tab-content" id="modelData">
                        <div class="tab-pane fade active show" id="siteSettings" role="tabpanel">
                            @include('Dashboard::settings.Partials.tabs.site-settings')
                        </div>
                        <div class="tab-pane fade" id="logoSettings" role="tabpanel">
                            @include('Dashboard::settings.Partials.tabs.logo-settings')
                        </div>
                        <div class="tab-pane fade" id="generalSettings" role="tabpanel">
                            @include('Dashboard::settings.Partials.tabs.general-settings')
                        </div>
                        <div class="tab-pane fade" id="developersSettings" role="tabpanel">
                            @include('Dashboard::settings.Partials.tabs.developer-settings')
                        </div>
                        <div class="tab-pane fade" id="socialSettings" role="tabpanel">
                            @include('Dashboard::settings.Partials.tabs.social-settings')
                        </div>
                        <div class="tab-pane fade" id="paymentSettings" role="tabpanel">
                            @include('Dashboard::settings.Partials.tabs.payment-settings')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right mt-10 mx-5">
                    <button type="submit" class="btn btn-primary mr-2 btn-lg px-15">
                        <i class="la la-edit"></i>
                        {{trans('Dashboard::dashboard.edit')}}
                    </button>
                    <a href="{{ URL::to('/'.$designElems['mainData']['url']) }}" class="btn btn-secondary btn-lg px-15">
                        <i class="la la-redo"></i>
                        {{trans('Dashboard::dashboard.back')}}
                    </a>
                </div>
            </div>
        </form> 
    </div>
</div>
@include('dashboard.Partials.photoswipe_modal')
@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/settings.js')}}"></script>
@endpush
