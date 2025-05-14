<?php

namespace Tests\Unit;

use App\Models\Hotel;
use App\Models\Room;
use App\Enums\RoomType;
use App\Enums\RoomStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function room_has_valid_attributes()
    {
        $hotel = Hotel::factory()->create(); 
        $room = Room::factory()->create([
            'hotel_id' => $hotel->id,
            'room_type' => RoomType::Single,  
            'status' => RoomStatus::Available, 
        ]);

        $this->assertEquals(RoomType::Single, $room->room_type); 
        $this->assertEquals(RoomStatus::Available, $room->status); 
        $this->assertNotNull($room->hotel_id);
        $this->assertNotNull($room->room_number);
    }
}
