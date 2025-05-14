<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Hotel',  
            'location' => $this->faker->address,        
            'description' => $this->faker->text,        
            'number_of_rooms' => $this->faker->numberBetween(1, 100), 
            'contact_info' => json_encode([              
                'phone' => $this->faker->phoneNumber,
                'email' => $this->faker->unique()->safeEmail,
            ]),
        ];

          
    }
}
