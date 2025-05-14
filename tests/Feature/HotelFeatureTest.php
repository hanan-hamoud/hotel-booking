<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_hotel_creation_page_loads()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/admin/hotels/create');

        $response->assertStatus(200);
        $response->assertSee('إضافة فندق');
    }

    public function test_user_can_create_a_hotel()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/admin/hotels', [
            'name' => 'New Hotel',
            'location' => 'New Location',
            'description' => 'This is a new hotel',
            'number_of_rooms' => 50,
            'phone' => '987654321',
            'email' => 'newhotel@example.com',
        ]);

        $response->assertRedirect('/admin/hotels');
        $this->assertDatabaseHas('hotels', [
            'name' => 'New Hotel',
        ]);
    }
}
