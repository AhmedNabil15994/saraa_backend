<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<h5 class="text-dark font-weight-bold my-1 mr-5">@yield('pageName')</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					@foreach($breadcrumbs as $one)
					<li class="breadcrumb-item">
						<a href="{{$one['url']}}" class="text-muted">{{$one['title']}}</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
<!--end::Subheader-->
@php
if(isset($tableURL) && $tableURL != ''){
	$designElems['mainData']['url'] = $tableURL;	
}
@endphp
@if(isset($designElems) && !empty($designElems))
<input type="hidden" name="designElems" value="{{ json_encode($designElems) }}">

@if(!isset($disableEdit) || $disableEdit != true)
<input type="hidden" name="data-area" value="{{ \Helper::checkRules('edit-'.$designElems['mainData']['nameOne']) }}">
@endif
@if(!isset($disableDelete) || $disableDelete != true)
<input type="hidden" name="data-cols" value="{{ \Helper::checkRules('delete-'.$designElems['mainData']['nameOne']) }}">
@endif
@if(!isset($disableRestore) || $disableRestore != true)
<input type="hidden" name="data-rows" value="{{ \Helper::checkRules('restore-'.$designElems['mainData']['nameOne']) }}">
@endif
@if(isset($hasView) && $hasView == true)
<input type="hidden" name="data-vws" value="{{ \Helper::checkRules('view-'.$designElems['mainData']['nameOne']) }}">
@endif

@endif