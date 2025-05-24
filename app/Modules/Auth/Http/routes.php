<?php
/*----------------------------------------------------------
Admin Auth
----------------------------------------------------------*/
Route::group(['prefix' => '/dashboard'] , function () {
    $authController = App\Http\Controllers\LoginController::class;

    Route::get('/login',[$authController,'showLogin']);
    Route::post('/login',[$authController,'doLogin']);
    Route::get('/logout',[$authController,'logout']);
    Route::get('/changeLang',[$authController,'changeLang']);




    Route::group(['prefix' => 'password'], function () {

        // Show Forget Password Form
        Route::get('forget', [App\Http\Controllers\ForgotPasswordController::class,'forgetPassword'])
            ->name('auth.password.request')
            ->middleware('guest');

        // Send Forget Password Via Mail
        Route::post('forget', [App\Http\Controllers\ForgotPasswordController::class,'sendForgetPassword'])
            ->name('auth.password.email');
    });

    Route::group(['prefix' => 'reset'], function () {

        // Show Forget Password Form
        Route::get('{token}', [App\Http\Controllers\ResetPasswordController::class,'resetPassword'])
            ->name('auth.password.reset')
            ->middleware('guest');

        // Send Forget Password Via Mail
        Route::post('/',  [App\Http\Controllers\ResetPasswordController::class,'updatePassword'])
            ->name('auth.password.update');
    });
});
