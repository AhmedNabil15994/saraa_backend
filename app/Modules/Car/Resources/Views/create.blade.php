{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('Car::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Car::Partials.tabs.general-data')
    </div>
    <div class="tab-pane fade" id="specialData" role="tabpanel">
        @include('Car::Partials.tabs.special-data')
    </div>
    <div class="tab-pane fade" id="reserveData" role="tabpanel">
        @include('Car::Partials.tabs.reserve-data')
    </div>
    <div class="tab-pane fade" id="mediaData" role="tabpanel">
        @include('Car::Partials.tabs.media-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/cars.js')}}"></script>
@endpush