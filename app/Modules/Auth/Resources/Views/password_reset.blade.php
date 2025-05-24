@extends('dashboard.Layouts.auth.master')
@section('title',trans('Auth::login.reset.mail.subject'))
@section('content')

<!--begin::Signin-->
<div class="login-form login-signin py-11">
	<!--begin::Form-->
	<form class="form" method="post" action="{{route('auth.password.update')}}">
		@csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

		<!--begin::Title-->
		<div class="text-center pb-8">
			<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">{{trans('Auth::login.forget.title')}}</h2>
		</div>
		<!--end::Title-->
		<!--begin::Form group-->
		<div class="form-group">
			<label class="font-size-h6 font-weight-bolder text-dark w-100 text-{{DIR1}}">{{trans('Auth::login.email')}}</label>
			<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" value="{{$email}}" readonly autocomplete="off" />
		</div>
		<!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark w-100 text-{{DIR1}}">{{trans('Auth::login.password')}}</label>
            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password"  autocomplete="off" />
        </div>
        <!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark w-100 text-{{DIR1}}">{{trans('Auth::login.password_confirmation')}}</label>
            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password_confirmation"  autocomplete="off" />
        </div>
        <!--end::Form group-->
		<!--begin::Action-->
		<div class="text-center pt-2">
			<button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3 loginBut">{{trans('Auth::login.reset.change_password')}}</button>
		</div>
		<!--end::Action-->
	</form>
	<!--end::Form-->
</div>
<!--end::Signin-->

@endsection
@section('scripts')
@endsection
