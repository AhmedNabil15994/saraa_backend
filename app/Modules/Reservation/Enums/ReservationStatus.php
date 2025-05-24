<?php namespace App\Modules\Reservation\Enums;
use MyCLabs\Enum\Enum;

class ReservationStatus extends Enum
{

    const STATUS_0 = 'UnCompleted';
    const STATUS_1 = 'Paid';
    const STATUS_2 = 'Pending';
    const statuses = [
        ['id'=>0,'title'=> self::STATUS_0],
        ['id'=>1,'title'=> self::STATUS_1],
        ['id'=>2,'title'=> self::STATUS_2],
    ];
}
