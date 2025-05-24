<?php


return [
    
    // 'AuthControllers@changeLang' => 'general',
    // 'AuthControllers@showLogin' => 'auth',
    // 'AuthControllers@doLogin' => 'auth',
    // 'AuthControllers@logout' => 'auth',
    


    'DashboardController@index' => 'general',
    'DashboardController@postPublish' => 'general',
    'ProfileController@index' => 'general',
    'ProfileController@update' => 'general',
    'SettingController@index' => 'list-project-settings',
    'SettingController@updateSiteSettings' => 'update-project-settings',
    'SettingController@general' => 'list-general-settings',
    'SettingController@updateGeneralSettings' => 'update-general-settings',

];
