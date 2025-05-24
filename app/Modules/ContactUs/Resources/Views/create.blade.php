{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('ContactUs::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('ContactUs::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection
