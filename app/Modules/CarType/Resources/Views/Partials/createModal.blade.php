<div class="modal fade" id="typeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{trans('CarType::carType.newOne')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="active show" role="tabpanel">
                    <ul class="nav nav-tabs nav-primary nav-tabs-space-lg nav-tabs-bold" role="tablist">
                        @foreach($available_locales as $key => $lang)
                        <li class="nav-item mx-2">
                            <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="type-tab-{{$key+1}}" data-toggle="tab" href="#type-{{$key+1}}">
                                <span class="nav-icon text-white">
                                    <i class="la la-language icon-xl"></i>
                                </span>
                                <span class="nav-text"> {{trans('Dashboard::dashboard.'.$lang['name'])}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content mt-5" id="typeTabContent">
                        @foreach($available_locales as $key => $lang)
                        <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="type-{{$key+1}}" role="tabpanel" aria-labelledby="type-tab-{{$key+1}}">
                            <div class="form-group p-0 m-0 mb-5 pt-5">
                                <label class="col-form-label">{{ trans('Category::category.form.name_'.$lang['prefix']) }} :</label>
                                <input type="text" class="form-control" name="title_{{$lang['prefix']}}" value="{{  old('title_'.$lang['prefix']) }}" placeholder="{{ trans('Category::category.form.name_'.$lang['prefix']) }}">
                            </div>
                        </div>
                        @endforeach
                    </div>                  

                    <div class="form-group row p-0 m-0 mb-5">
                        <label class="col-form-label">{{ trans('Role::role.form.status') }} :</label>
                        <div class="col-12 p-0">
                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox" value="1" name="status" checked />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary font-weight-bold save">{{trans('Dashboard::dashboard.save')}}</button>
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">{{trans('Dashboard::dashboard.close')}}</button>
            </div>
        </div>
    </div>
</div>