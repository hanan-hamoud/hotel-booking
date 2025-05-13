<div>
<!-- resources/views/livewire/room-search.blade.php -->
<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-semibold mb-4">Search Available Rooms</h2>

    <form wire:submit.prevent="search">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Hotel</label>
                <input type="text" wire:model="hotel" class="w-full px-4 py-2 border rounded" placeholder="Enter hotel name">
            </div>

            <div>
                <label class="block font-medium">Room Type</label>
                <select wire:model="roomType" class="w-full px-4 py-2 border rounded">
                    <option value="">Any</option>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="suite">Suite</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Price Range</label>
                <input type="text" wire:model="priceRange" class="w-full px-4 py-2 border rounded" placeholder="e.g. 100-300">
            </div>

            <div>
                <label class="block font-medium">Availability Date</label>
                <input type="date" wire:model="availabilityDate" class="w-full px-4 py-2 border rounded">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Search
            </button>
        </div>
    </form>

    @if($rooms && count($rooms) > 0)
        <div class="mt-8">
            <h3 class="text-xl font-semibold mb-2">Available Rooms</h3>
            <ul class="space-y-4">
                @foreach($rooms as $room)
                    <li class="p-4 border rounded shadow-sm">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-bold">{{ $room->hotel->name }} - {{ $room->type }}</h4>
                                <p class="text-sm text-gray-600">Price: ${{ $room->price }} | Available from: {{ $room->available_from }}</p>
                            </div>
                            <a href="{{ route('book-room', ['room' => $room->id]) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Book Now
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

</div>
