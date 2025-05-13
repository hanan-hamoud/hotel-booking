<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Booking Report</h2>

    <table>
        <thead>
            <tr>
                <th>Hotel Name</th>
                <th>Guest Name</th>
                <th>Contact Email</th>
                <th>Room Type</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total (ريال)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ optional($booking->room?->hotel)->name ?? 'N/A' }}</td>
                    <td>{{ $booking->guest_name }}</td>
                    <td>{{ $booking->guest_email }}</td>
                    <td>{{ $booking->room->room_type->value ?? 'N/A' }}</td>
                    <td>{{ $booking->check_in_date }}</td>
                    <td>{{ $booking->check_out_date }}</td>
                    <td>
                        {{ optional($booking->room)->price_per_night * \Carbon\Carbon::parse($booking->check_in_date)->diffInDays($booking->check_out_date) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
