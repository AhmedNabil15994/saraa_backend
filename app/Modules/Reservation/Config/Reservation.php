<?php

return [
    'title'=>'Reservation', 
    'permissions'=>  [
        'ReservationController@index' => 'list-reservations', 
        'ReservationController@paid' => 'paid-reservations', 
        'ReservationController@pending' => 'pending-reservations', 
        'ReservationController@unCompleted' => 'unCompleted-reservations', 
        'ReservationController@view' => 'view-reservation', 
        'ReservationController@update' => 'update-reservation', 
        'ReservationController@restore' => 'restore-reservation', 
        'ReservationController@delete' => 'delete-reservation', 
        'ReservationController@destroy' => 'delete-reservation', 
    ], 
];