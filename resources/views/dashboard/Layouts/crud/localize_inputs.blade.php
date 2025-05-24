<ul class="nav nav-tabs nav-primary nav-tabs-space-lg nav-tabs-bold" role="tablist">
    @foreach($available_locales as $key => $lang)
    <li class="nav-item mx-2">
        <a class="nav-link {{$key == 0 ? 'active' : ''}}" id="home-tab-{{$key+1}}" data-toggle="tab" href="#home-{{$key+1}}">
            <span class="nav-icon text-white">
                <i class="la la-language icon-xl"></i>
            </span>
            <span class="nav-text"> {{trans('Dashboard::dashboard.'.$lang['name'])}}</span>
        </a>
    </li>
    @endforeach
</ul>