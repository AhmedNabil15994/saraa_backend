{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.create')

@section('crud-tabs')
    @include('Brand::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Brand::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/brands.js')}}"></script>
@endpush