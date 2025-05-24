{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('breadcrumbs')
@include('dashboard.Layouts.breadcrumb',[
    'breadcrumbs' => [
        [
            'title' => trans('Dashboard::dashboard.menu'),
            'url' => \URL::to('/dashboard')
        ],
        [
            'title' => trans($designElems['mainData']['modelName'].'::'.lcfirst($designElems['mainData']['nameOne']).'.title'),
            'url' => \URL::to('/'.$designElems['mainData']['url'])
        ],
        [
            'title' => $editName,
            'url' => \URL::current()
        ],
    ]
])
@endsection

@section('content')
<div class="d-flex flex-row">
    @yield('crud-tabs')
    <div class="flex-row-fluid ml-lg-8">
        <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/update/'.$model->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="card card-custom card-stretch">
                <div class="card-body">
                    <div class="tab-content" id="modelData">
                        @yield('crud-data')
                    </div>
                </div>
                <div class="card-footer text-right mt-10 mx-5">
                    <button type="submit" class="btn btn-primary mr-2 btn-lg px-15">
                        <i class="la la-edit"></i>
                        {{trans('Dashboard::dashboard.edit')}}
                    </button>
                    <a href="{{ URL::to('/'.$designElems['mainData']['url']) }}" class="btn btn-secondary btn-lg px-15">
                        <i class="la la-redo"></i>
                        {{trans('Dashboard::dashboard.back')}}
                    </a>
                </div>
            </div>
        </form> 
    </div>
</div>

@yield('extra-content')
@endsection

@section('modals')
@include('dashboard.Partials.photoswipe_modal')
@endsection