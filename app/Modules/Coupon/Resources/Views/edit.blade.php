{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->code; @endphp

@section('crud-tabs')
    @include('Coupon::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Coupon::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/coupons.js')}}"></script>
@endpush
