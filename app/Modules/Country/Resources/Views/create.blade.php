{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('Country::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Country::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/countries.js')}}"></script>
@endpush