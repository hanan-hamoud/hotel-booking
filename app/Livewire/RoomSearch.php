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
        $this->rooms = Room::query()
            ->when($this->hotel, fn($q) => $q->whereHas('hotel', fn($q) => $q->where('name', 'like', "%{$this->hotel}%")))
            ->when($this->roomType, fn($q) => $q->where('type', $this->roomType))
            ->when($this->priceRange, function($q) {
                [$min, $max] = explode('-', $this->priceRange);
                return $q->whereBetween('price', [(float)$min, (float)$max]);
            })
            ->when($this->availabilityDate, fn($q) => $q->whereDate('available_from', '<=', $this->availabilityDate))
            ->get();
    }

    public function render()
    {
        return view('livewire.room-search');
    }
}
