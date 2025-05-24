{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->name; @endphp

@section('crud-tabs')
    @include('Seller::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Seller::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/users.js')}}"></script>
@endpush
