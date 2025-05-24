<?php namespace App\Modules\Reservation\Enums;
use MyCLabs\Enum\Enum;

class ReservationAddressKeys extends Enum
{

    const STREET = 'street';
    const BLOCK = 'block';
    const BUILDING = 'building';

    static function getConstants() {
        return [
            self::STREET,
            self::BLOCK,
            self::BUILDING,
        ];
    }
}
