{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('EmployeeRole::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('EmployeeRole::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
@endpush