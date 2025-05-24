{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('styles')
<style type="text/css">
    .checkbox-single{
        width: 50px;
    }
    html[dir="rtl"] .form:not(.main) input[type="checkbox"]{
        right: 20px;
    }
    .form p.data{
        display: inline-block;
        margin-bottom: 0;
        font-weight: bold;
    }
</style>
@endsection
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
            'title' => trans($designElems['mainData']['addOne']),
            'url' => \URL::current()
        ],
    ]
])
@endsection
{{-- Content --}}


@section('content')

<div class="card card-custom formNumbers">
    <div class="card-header">
        <h3 class="card-title"><i class="{{ $designElems['mainData']['icon'] }}"></i> {{$designElems['mainData']['title']}}</h3>
    </div>
    <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/create') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <input type="hidden" name="status">

            <div class="form-group mb-3">
                <label for="inputEmail3">{{ trans('main.titleAr') }} :</label>
                <input type="text" class="title_ar form-control" name="title_ar" value="{{old('title_ar')}}" placeholder="{{ trans('main.titleAr') }}">
            </div>
            <div class="form-group mb-3">
                <label for="inputEmail4" class="titleLabel">{{ trans('main.titleEn') }} :</label>
                <input type="text" class="title_en form-control" name="title_en" value="{{old('title_en')}}" placeholder="{{ trans('main.titleEn') }}">
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary mr-2">{{trans('Dashboard::dashboard.add')}}</button>
                <a href="{{ URL::to('/'.$designElems['mainData']['url']) }}" class="btn btn-secondary">{{trans('Dashboard::dashboard.back')}}</a>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
@endsection
