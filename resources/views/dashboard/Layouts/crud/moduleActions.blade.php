@if(!isset($data->dis) || $data->dis != true)
    @if(\Helper::checkRules('add-'.$designElems['mainData']['nameOne']) && (!isset($data->disAdd) || $data->disAdd != true))
        <!--begin::Button-->
        <a class="btn btn-primary font-weight-bolder mr-2" href="{{ URL::to('/'.$designElems['mainData']['url'].'/add') }}">
                <span class="svg-icon svg-icon-md">
                    <i class="flaticon-add"></i>
                </span>
            {{ $designElems['mainData']['addOne'] }}
        </a>
        <!--end::Button-->
    @endif
    @if(\Helper::checkRules('delete-'.$designElems['mainData']['nameOne']))
        <a class="btn btn-danger deleteSelected hidden font-weight-bolder mr-2" href="#">
            <span class="svg-icon svg-icon-md">
                    <i class="flaticon-delete"></i>
                </span>
            {{ trans('Dashboard::dashboard.deleteSelected') }}
        </a>
    @endif
    @if(\Helper::checkRules('edit-'.$designElems['mainData']['nameOne']) && (!isset($data->disFastEdit) || $data->disFastEdit != true))
        <a href="#" class="edit quickEdit btn btn-icon btn-light-warning btn-md mr-2" data-toggle="tooltip" data-original-title="{{ trans('Dashboard::dashboard.fastEdit') }}"><i class="flaticon2-edit"></i></a>
    @endif
@endif
