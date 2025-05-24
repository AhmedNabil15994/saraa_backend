@extends('dashboard.Layouts.auth.master')
@section('title',trans('Auth::login.title'))
@section('content')

<!--begin::Signin-->
<div class="login-form login-signin py-11">
	<!--begin::Form-->
	<form class="form" method="post" action="{{URL::current()}}">
		@csrf

		<!--begin::Title-->
		<div class="text-center pb-8">
			<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">{{trans('Auth::login.title')}}</h2>
		</div>
		<!--end::Title-->
		<!--begin::Form group-->
		<div class="form-group">
			<label class="font-size-h6 font-weight-bolder text-dark w-100 text-{{DIR1}}">{{trans('Auth::login.email')}}</label>
			<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" autocomplete="off" />
		</div>
		<!--end::Form group-->
		<!--begin::Form group-->
		<div class="form-group">
			<label class="font-size-h6 font-weight-bolder text-dark w-100 text-{{DIR1}} pt-5">{{trans('Auth::login.password')}}</label>
			<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
		</div>
		<!--end::Form group-->
        <div class="text-center pt-2">
            <a class="font-weight-bolder font-size-h6 px-8 py-4 my-3" href="{{route('auth.password.request')}}">{{trans('Auth::login.forget.btn')}}</a>
        </div>
		<!--begin::Action-->
		<div class="text-center pt-2">
			<button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3 loginBut">{{trans('Auth::login.btn')}}</button>
		</div>
		<!--end::Action-->
	</form>
	<!--end::Form-->
</div>
<!--end::Signin-->

@endsection
@section('scripts')
@endsection
