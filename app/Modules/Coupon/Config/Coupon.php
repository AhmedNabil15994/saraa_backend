<?php

return [
         'title'=>'Coupon', 
         'permissions'=>  [
       'CouponController@index' => 'list-coupons', 
        'CouponController@create' => 'add-coupon', 
        'CouponController@store' => 'add-coupon', 
        'CouponController@edit' => 'edit-coupon', 
        'CouponController@update' => 'edit-coupon', 
        'CouponController@fastEdit' => 'edit-coupon', 
        'CouponController@restore' => 'restore-coupon', 
        'CouponController@delete' => 'delete-coupon', 
        'CouponController@destroy' => 'delete-coupon', 
        ], 
         ];