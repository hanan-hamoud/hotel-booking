<?php

namespace App;

enum status: string {
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Completed = 'completed';

    public function label(): string
    {
        return match($this) {
            self::Confirmed => 'Confirmed Room',
            self::Cancelled => 'Cancelled Room',
            self::Completed  => 'Completed Room',
        };
    }
}
