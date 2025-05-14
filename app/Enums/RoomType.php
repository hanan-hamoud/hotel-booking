<?php

namespace App\Enums;

enum RoomType: string {
    case Single = 'single';
    case Double = 'double';
    case Suite = 'suite';
    public function label(): string
    {
        return match($this) {
            self::Single => 'Single Room',
            self::Double => 'Double Room',
            self::Suite  => 'Suite Room',
            
        };
    }
}

