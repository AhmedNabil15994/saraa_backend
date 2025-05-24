{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('styles')

@endsection

@section('breadcrumbs')
@include('dashboard.Layouts.breadcrumb',[
    'breadcrumbs' => [
        [
            'title' => trans('Dashboard::dashboard.menu'),
            'url' => \URL::to('/dashboard')
        ],
        [
            'title' => $designElems['mainData']['title'],
            'url' => $designElems['mainData']['url']
        ],
    ]
])
@endsection

@section('content')

<input type="hidden" name="designElems" value="{{ json_encode($designElems) }}">

@if(!isset($data->dis) || $data->dis != true)
<input type="hidden" name="data-area" value="{{ \Helper::checkRules('edit-'.$designElems['mainData']['nameOne']) }}">
<input type="hidden" name="data-cols" value="{{ \Helper::checkRules('delete-'.$designElems['mainData']['nameOne']) }}">
@endif


<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="{{ $designElems['mainData']['icon'] }} text-primary"></i>
            </span>
            <h3 class="card-label">{{ $designElems['mainData']['title'] }}</h3>
        </div>
        <div class="card-toolbar">

            @include('dashboard.Partials.export')

            @include('dashboard.Partials.moduleActions')
        </div>
    </div>
    <div class="card-body">
        @include('dashboard.Partials.searchForm')
        @include('dashboard.Partials.dataTable')
    </div>
</div>
<!--end::Card-->

@endsection


{{-- Scripts Section --}}

@section('scripts')
<script src="{{ asset('assets/dashboard/components/globals.js')}}"></script>
<script src="{{ asset('assets/dashboard/components/datatables.js')}}"></script>
@endsection
