<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;

class RoomSearch extends Component
{
    public $hotel, $roomType, $priceRange, $availabilityDate;
    public $rooms;
    public function search()
    {
        $query = Room::query();
    
        if ($this->hotel) {
            $query->whereHas('hotel', function ($query) {
                $query->where('name', 'like', '%' . $this->hotel . '%');
            });
        }
    
        if ($this->roomType) {
            $query->where('room_type', $this->roomType);
        }
    
        if ($this->priceRange) {
            list($minPrice, $maxPrice) = explode('-', $this->priceRange);
            $query->whereBetween('price_per_night', [(float)$minPrice, (float)$maxPrice]);
        }
    
        if ($this->availabilityDate) {
            $query->whereDate('available_from', '>=', $this->availabilityDate);
        }
    
        $this->rooms = $query->get();
    }
    

    public function render()
    {
        return view('livewire.room-search');
    }
}
