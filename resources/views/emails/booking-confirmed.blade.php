
<h2>Booking Confirmed</h2>

<p>Dear {{ $booking->guest_name }},</p>

<p>Your booking for Room #{{ $booking->room->room_number }} has been confirmed.</p>

<ul>
    <li><strong>Check In:</strong> {{ $booking->check_in_date }}</li>
    <li><strong>Check Out:</strong> {{ $booking->check_out_date }}</li>
</ul>

<p>We look forward to welcoming you!</p>
