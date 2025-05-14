<?php

namespace Database\Factories;
use  App\Models\Room;
use App\Models\Hotel;
use App\Enums\RoomType; 
use App\Enums\RoomStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
            'hotel_id' => \App\Models\Hotel::factory(),
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'room_type' => $this->faker->randomElement(RoomType::cases())->value, 
            'price_per_night' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->randomElement(RoomStatus::cases())->value,
        ];
    }
}
