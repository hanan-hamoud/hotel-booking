<?php
namespace App\Http\Livewire;

use Livewire\Component;

class BookRoom extends Component
{
    public $room;

    public function mount($room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.book-room');
    }
}
