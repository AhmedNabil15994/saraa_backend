{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@push('css')
<style>
    .card-header{
        flex-direction: row-reverse;
    }
</style>
@endpush

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
    ],
])
@endsection

@section('content')

@include('dashboard.Layouts.crud.searchForm')

<!--begin::Card-->
<div class="card card-custom">

    <div class="card-header">

        <div class="card-title">
            @include('dashboard.Layouts.crud.searchToggles')
        </div>

        <div class="card-toolbar">
            @include('dashboard.Layouts.crud.export')
            @include('dashboard.Layouts.crud.moduleActions')
        </div>
    </div>

    <div class="card-body">
        @include('dashboard.Layouts.crud.dataTable')
    </div>
</div>
<!--end::Card-->

@yield('extra-content')

@endsection

{{-- Scripts Section --}}
@push('js')
<script src="{{ asset('assets/dashboard/components/datatables.js')}}"></script>
@endpush