{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.index')

@php
	$tableURL = $designElems['mainData']['url'].'?status=1';
@endphp

@section('extra-content')

@endsection