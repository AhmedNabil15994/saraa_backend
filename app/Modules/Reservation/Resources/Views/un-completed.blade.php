{{-- Extends layout --}}
@extends('dashboard.Layouts.crud.index')
@php
	$tableURL = $designElems['mainData']['url'].'?status=0';
@endphp
@section('extra-content')

@endsection