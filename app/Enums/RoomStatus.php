<?php

namespace App\Enums;

enum RoomStatus: string
{
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Confirmed => 'Confirmed',
            self::Cancelled => 'Cancelled',
            self::Completed => 'Completed',
        };
    }
}
