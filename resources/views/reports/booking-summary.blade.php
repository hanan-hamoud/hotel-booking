<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير الحجوزات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>تقرير الحجوزات</h1>
    <table>
        <thead>
            <tr>
                <th>اسم الفندق</th>
                <th>اسم الضيف</th>
                <th>معلومات الاتصال</th>
                <th>نوع الغرفة</th>
                <th>تاريخ الدخول</th>
                <th>تاريخ الخروج</th>
                <th>المبلغ الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->hotel->name }}</td>
                    <td>{{ $booking->guest_name }}</td>
                    <td>{{ $booking->guest_contact }}</td>
                    <td>{{ $booking->room->type }}</td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                    <td>{{ $booking->total_amount }} ريال</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
