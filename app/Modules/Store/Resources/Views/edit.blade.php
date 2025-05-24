{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->title; @endphp

@section('crud-tabs')
    @include('Store::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Store::Partials.tabs.general-data')
    </div>
    <div class="tab-pane fade" id="locationData" role="tabpanel">
        @include('Store::Partials.tabs.location-data')
    </div>
    <div class="tab-pane fade" id="contactData" role="tabpanel">
        @include('Store::Partials.tabs.contact-data')
    </div>
    <div class="tab-pane fade" id="workDaysData" role="tabpanel">
        @include('Store::Partials.tabs.work-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/stores.js')}}"></script>
<script>
    $(function(){
        $('select[name="country_id"]').val("{{$model->State->City->country_id}}")
    })
</script>
@endpush
