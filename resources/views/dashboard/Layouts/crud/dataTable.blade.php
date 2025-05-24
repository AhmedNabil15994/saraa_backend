<!--begin: Datatable-->
<table class="table table-checkable table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
    <thead>
        <tr>
            <th></th>
            @foreach($designElems['tableData'] as $one)
            <th>{{ $one['label'] }}</th>
            @endforeach
        </tr>
    </thead>
</table>
<!--end: Datatable-->