{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.edit')

@php $editName = $model->{'title_'.LANGUAGE_PREF}; @endphp

@section('crud-tabs')
    @include('Category::Partials.tabs.tabs')
@endsection

@section('crud-data')
    <div class="tab-pane fade active show" id="generalData" role="tabpanel">
        @include('Category::Partials.tabs.general-data')
    </div>
@endsection

@section('extra-content')

@endsection

@push('js')
<script src="{{asset('assets/dashboard/components/categories.js')}}"></script>
@endpush
