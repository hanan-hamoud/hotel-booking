<?php

namespace App\Enums;

enum RoomStatus: string
{
    case Available = 'available';
    case Booked = 'booked';
    case UnderMaintenance = 'Under Maintenance';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Booked => 'booked',
            self::UnderMaintenance => 'Under Maintenance',
        };
    }
}
