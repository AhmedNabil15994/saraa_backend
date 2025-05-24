@push('css')
<style>
	.catRow:not(.last),.tree-icon {
	    background-image: url({{asset('assets/dashboard/plugins/custom/jstree/32px.png')}});
	}
</style>
@endpush

@php $hasChilds = isset($category->children) && count($category->children) > 0 ? 1 : 0;  @endphp
@if($hasChilds)
	<button type="button" class="btn btn-xs btn-default btn-icon float-left"><i class="fa fa-minus"></i></button>
@endif

<div class="catRow row m-0 p-0  {{$hasChilds ? '' : 'last'}}   {{$level>1 && $hasChilds ? 'fixButtons' : 'mb-2'}}">
	<div class="checkbox-list  {{$level != 1 ? 'ml-7 children' : ''}}">
	    <label class="checkbox {{$hasChilds ? 'parent' : 'child'}}">
			<i class="tree-icon"></i>
	        <input class="main" type="checkbox" value="{{$category->id}}" name="category_ids[]"/>
	        <span></span>
	        {{ $category->name }}
	    </label>

	    @if ($hasChilds)
	    @php $level+=1; @endphp
	    @foreach($category->children as $category)
	        @include('Category::Partials.category-tree', [
	        	'category' => $category,
	        	'level' => $level,
	        ])
	    @endforeach
	    @endif
	</div>
</div>
