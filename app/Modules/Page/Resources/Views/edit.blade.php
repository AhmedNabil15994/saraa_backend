{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->name; @endphp

@section('crud-tabs')
    @include('Page::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Page::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/pages.js')}}"></script>
@endpush
