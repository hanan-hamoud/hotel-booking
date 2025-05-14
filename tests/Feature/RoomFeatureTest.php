<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use App\Enums\RoomType;
use App\Enums\RoomStatus;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Filament\Resources\RoomResource\Pages\ListRooms;
use App\Filament\Resources\RoomResource\Pages\CreateRoom;
use App\Filament\Resources\RoomResource\Pages\EditRoom;

class RoomFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_list_rooms()
    {
        $hotel = Hotel::factory()->create();
        $rooms = Room::factory()->count(5)->create(['hotel_id' => $hotel->id]);

        Livewire::test(ListRooms::class)
            ->assertCanSeeTableRecords($rooms);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_room()
    {
        $hotel = Hotel::factory()->create();

        Livewire::test(CreateRoom::class)
            ->fillForm([
                'hotel_id' => $hotel->id,
                'room_number' => '101',
                'room_type' => RoomType::Suite->value,
                'price_per_night' => 150.00,
                'status' => RoomStatus::Available->value,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('rooms', [
            'room_number' => '101',
            'room_type' => RoomType::Suite->value,
            'status' => RoomStatus::Available->value,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_edit_a_room()
    {
        $room = Room::factory()->create([
            'room_type' => RoomType::Single,
            'status' => RoomStatus::Available,
        ]);

        Livewire::test(EditRoom::class, [
            'record' => $room->getKey(),
        ])
            ->fillForm([
                'room_number' => '202',
                'room_type' => RoomType::Double->value,
                'price_per_night' => 250.00,
                'status' => RoomStatus::Booked->value,
                'hotel_id' => $room->hotel_id,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'room_number' => '202',
            'room_type' => RoomType::Double->value,
            'status' => RoomStatus::Booked->value,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_room()
    {
        $room = Room::factory()->create();

        Livewire::test(ListRooms::class)
            ->callTableAction('delete', $room);

        $this->assertDatabaseMissing('rooms', [
            'id' => $room->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_fails_to_create_room_with_missing_required_fields()
    {
        $hotel = Hotel::factory()->create();

        Livewire::test(CreateRoom::class)
            ->fillForm([
                'room_number' => '',
                'room_type' => '',
                'price_per_night' => '',
                'status' => '',
                'hotel_id' => '',
            ])
            ->call('create')
            ->assertHasFormErrors(['room_number', 'room_type', 'price_per_night', 'status', 'hotel_id']);
    }
}
