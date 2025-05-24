@if(!empty($designElems['toggleData']))
@foreach($designElems['toggleData'] as $searchKey => $searchItem)
    @if($searchItem['type'] == 'toggle')
    <div class="col searchForm">
        <div class="form-group row mb-0">
            <div class="col-9">
                <label>{{ $searchItem['label'] }}</label>
            </div>
            <div class="col-3">
                <span class="switch switch-sm switch-icon">
                    <label>
                        <input type="checkbox" class="{{ $searchItem['class'] }}" value="1" {{isset($searchItem['checked']) && $searchItem['checked'] ? 'checked' : ''}} name="{{ $searchKey }}"/>
                        <span></span>
                    </label>
                </span>
            </div>
        </div>
    </div>
    @endif
@endforeach
@endif
