{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('Reservation::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Reservation::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/reservations.js')}}"></script>
@endpush