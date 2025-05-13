<x-filament::page>
    <h2 class="text-2xl mb-4">Booking Report</h2>

    @if ($bookings->isEmpty())
        <p class="text-center text-red-500">No bookings available for this report.</p>
    @else
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Hotel Name</th>
                    <th class="px-4 py-2 border">Guest Name</th>
                    <th class="px-4 py-2 border">Contact Information</th>
                    <th class="px-4 py-2 border">Room Type</th>
                    <th class="px-4 py-2 border">Check-in Date</th>
                    <th class="px-4 py-2 border">Check-out Date</th>
                    <th class="px-4 py-2 border">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td class="px-4 py-2 border">{{ $booking->hotel->name }}</td>
                        <td class="px-4 py-2 border">{{ $booking->guest_name }}</td>
                        <td class="px-4 py-2 border">{{ $booking->guest_email }}</td>
                        <td class="px-4 py-2 border">{{ $booking->room->room_type }}</td>
                        <td class="px-4 py-2 border">{{ $booking->check_in_date }}</td>
                        <td class="px-4 py-2 border">{{ $booking->check_out_date }}</td>
                        <td class="px-4 py-2 border">{{ $booking->room->price_per_night * $booking->check_in_date->diffInDays($booking->check_out_date) }} ريال</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <form method="POST" action="{{ route('admin.booking-report.download') }}">
        @csrf
        <button type="submit" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded">Download as PDF</button>
    </form>
</x-filament::page>
