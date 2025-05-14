<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">{{ __('Book a Room') }}</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="bookRoom" class="space-y-4">

        <div>
            <label>Guest Name</label>
            <input type="text" wire:model="guest_name" class="w-full px-4 py-2 border rounded">
            @error('guest_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Email</label>
            <input type="email" wire:model="guest_email" class="w-full px-4 py-2 border rounded">
            @error('guest_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Phone</label>
            <input type="text" wire:model="guest_phone" class="w-full px-4 py-2 border rounded">
            @error('guest_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Check In</label>
            <input type="date" wire:model="check_in_date" class="w-full px-4 py-2 border rounded">
            @error('check_in_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Check Out</label>
            <input type="date" wire:model="check_out_date" class="w-full px-4 py-2 border rounded">
            @error('check_out_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Special Request</label>
            <textarea wire:model="special_request" class="w-full px-4 py-2 border rounded"></textarea>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Confirm Booking</button>
        </div>

    </form>
</div>
