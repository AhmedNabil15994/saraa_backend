{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->title; @endphp

@section('crud-tabs')
    @include('Slider::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Slider::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/slider.js')}}"></script>
@endpush
