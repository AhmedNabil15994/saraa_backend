{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->id; @endphp

@section('crud-tabs')
    @include('CarType::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('CarType::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/carTypes.js')}}"></script>
@endpush
