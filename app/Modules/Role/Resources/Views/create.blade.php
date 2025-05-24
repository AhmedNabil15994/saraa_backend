{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('Role::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Role::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
@endpush