@if(!empty($designElems['searchData']))
<div class="card card-custom mb-5">
    <div class="card-header" style="flex-direction: unset;">
        <div class="card-title">
            <span class="card-icon">
                <i class="la la-search text-primary"></i>
            </span>
            <h3 class="card-label">{{ trans('Dashboard::dashboard.search') }} {{ $designElems['mainData']['title'] }}</h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Search Form-->
        <form class="searchForm">
            <div class="row">
                @foreach($designElems['searchData'] as $searchKey => $searchItem)
                <div class="col-lg-3 mb-lg-4 mb-6">
                    <label>{{ $searchItem['label'] }}</label>
                    @if(in_array($searchItem['type'],['email','text','number','password']))
                    
                        @if($searchKey == 'date')
                            <div class="input-daterange input-group" id="kt_datepicker_5">
                                <input type="{{ $searchItem['type'] }}" class="{{ $searchItem['class'] }}" name="from" placeholder="{{trans('Dashboard::dashboard.start_date')}}" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-ellipsis-h"></i>
                                    </span>
                                </div>
                                <input type="{{ $searchItem['type'] }}" class="{{ $searchItem['class'] }}" name="to" placeholder="{{trans('Dashboard::dashboard.end_date')}}" />
                            </div>
                        @else
                            <input type="{{ $searchItem['type'] }}" data-col-index="{{$searchItem['index']}}" class="{{ $searchItem['class'] }} w-100" value="{{ Request::get($searchKey) }}" placeholder="{{ $searchItem['label'] }}" name="{{ $searchKey }}">
                        @endif
                    @endif
                    @if($searchItem['type'] == 'select')
                        <select class="form-control" data-toggle="select2" name="{{ $searchKey }}">
                            <option value="">{{ trans('Dashboard::dashboard.choose') }}</option>
                            @foreach($searchItem['options'] as $group)
                                <option value="{{ $group['id'] }}">{{ $group['title'] }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="row mt-4">
                <div class="col-lg-12 text-right">
                    <button class="btn btn-primary btn-primary--icon" id="kt_search">
                        <span>
                            <i class="la la-search"></i>
                            <span>{{trans('Dashboard::dashboard.search')}}</span>
                        </span>
                    </button>
                    <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                        <span>
                            <i class="la la-close"></i>
                            <span>{{trans('Dashboard::dashboard.cancel')}}</span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
        <!--end: Search Form-->
    </div>
</div>
@endif
