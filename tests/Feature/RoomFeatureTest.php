<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\Room;
use App\Enums\RoomType;
use App\Enums\RoomStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function user_can_create_room()
    {
        $hotel = Hotel::factory()->create();

        $response = $this->post('/admin/rooms', [
            'hotel_id' => $hotel->id,
            'room_number' => '101',
            'room_type' => RoomType::Double->value,
            'price_per_night' => 150.00,
            'status' => RoomStatus::Available->value,
        ]);

        $response->assertStatus(201); 
        $this->assertDatabaseHas('rooms', [
            'hotel_id' => $hotel->id,
            'room_number' => '101',
            'room_type' => RoomType::Double->value,
            'price_per_night' => 150.00,
            'status' => RoomStatus::Available->value,
        ]);
    }

    /** @test */
    public function user_can_view_room()
    {
        $room = Room::factory()->create();

        $response = $this->get('/admin/rooms/' . $room->id);

        $response->assertStatus(200); 
        $response->assertJson([
            'room_number' => $room->room_number,
            'room_type' => $room->room_type,
            'status' => $room->status,
        ]);
    }

    /** @test */
    public function user_can_update_room()
    {
        $room = Room::factory()->create();

        $response = $this->put('/admin/rooms/' . $room->id, [
            'room_number' => '102',
            'room_type' => RoomType::Suite->value,
            'price_per_night' => 250.00,
            'status' => RoomStatus::Booked->value,
        ]);

        $response->assertStatus(200); 
        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'room_number' => '102',
            'room_type' => RoomType::Suite->value,
            'price_per_night' => 250.00,
            'status' => RoomStatus::Booked->value,
        ]);
    }

    /** @test */
    public function user_can_delete_room()
    {
        $room = Room::factory()->create();

        $response = $this->delete('/admin/rooms/' . $room->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('rooms', [
            'id' => $room->id,
        ]);
    }
}

