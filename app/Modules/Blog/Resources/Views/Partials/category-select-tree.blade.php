<optgroup label="{{  $oneCategory->{'name_'.LANGUAGE_PREF}  }}">
    @foreach($oneCategory->children as $oneChild)
        @if(count($oneChild->children))
	        @include('Blog::Partials.category-select-tree', [
	        	'oneCategory' => $oneChild,
	        ])
        @else
            <option value="{{$oneChild->id}}" {{$oneChild->id == ( isset($model) ? $model->category_id : old('category_id') ) ? 'selected' : ''}} >{{  $oneChild->name  }}</option>
        @endif
    @endforeach
</optgroup>

