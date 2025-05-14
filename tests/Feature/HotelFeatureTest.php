<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Filament\Resources\HotelResource\Pages\ListHotels;
use App\Filament\Resources\HotelResource\Pages\CreateHotel;

class HotelFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(); // إذا كنت تستخدم تحقق من الصلاحيات
        $this->actingAs($user);
    }

    /** @test */
    public function it_can_list_hotels()
    {
        $hotels = Hotel::factory()->count(10)->create();

        Livewire::test(ListHotels::class)
            ->assertCanSeeTableRecords($hotels);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_hotel()
    {
        $admin = User::factory()->create(); // تم حذف is_admin
        $this->actingAs($admin);
    
        Livewire::test(\App\Filament\Resources\HotelResource\Pages\CreateHotel::class)
            ->fillForm([
                'name' => 'فندق النخبة',
                'location' => 'صنعاء',
                'description' => 'فندق خمس نجوم',
                'number_of_rooms' => 100,
                'contact_info' => [
                    'phone' => '777777777',
                    'email' => 'elite@hotel.com',
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();
    
        $this->assertDatabaseHas('hotels', [
            'name' => 'فندق النخبة',
            'location' => 'صنعاء',
        ]);
    }
    #[\PHPUnit\Framework\Attributes\Test]
public function it_can_edit_a_hotel()
{
    $hotel = Hotel::factory()->create([
        'name' => 'فندق قديم',
        'location' => 'عدن',
    ]);

    Livewire::test(\App\Filament\Resources\HotelResource\Pages\EditHotel::class, [
        'record' => $hotel->getKey(),
    ])
        ->fillForm([
            'name' => 'فندق محدث',
            'location' => 'صنعاء',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('hotels', [
        'id' => $hotel->id,
        'name' => 'فندق محدث',
        'location' => 'صنعاء',
    ]);
}


#[\PHPUnit\Framework\Attributes\Test]
public function it_can_delete_a_hotel()
{
    $hotel = Hotel::factory()->create();

    Livewire::test(ListHotels::class)
        ->callTableAction('delete', $hotel);

    $this->assertDatabaseMissing('hotels', [
        'id' => $hotel->id,
    ]);
}

#[\PHPUnit\Framework\Attributes\Test]
public function it_fails_to_create_hotel_with_missing_required_fields()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(\App\Filament\Resources\HotelResource\Pages\CreateHotel::class)
        ->fillForm([
            'name' => '', // مفقود
            'location' => '', // مفقود
        ])
        ->call('create')
        ->assertHasFormErrors(['name', 'location']);
}
   
#[\PHPUnit\Framework\Attributes\Test]
public function it_can_update_a_hotel()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $hotel = Hotel::factory()->create();

    Livewire::test(\App\Filament\Resources\HotelResource\Pages\EditHotel::class, [
        'record' => $hotel->getRouteKey(),
    ])
        ->fillForm([
            'name' => 'فندق التميز',
            'location' => 'عدن',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('hotels', [
        'id' => $hotel->id,
        'name' => 'فندق التميز',
        'location' => 'عدن',
    ]);
}




}
