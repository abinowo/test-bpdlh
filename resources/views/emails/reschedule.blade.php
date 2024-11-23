<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h1 style="color: #0056b3;">Reschedule Request</h1>

    <p>Hello {{ $booking['customer_name'] }},</p>

    <p>We would like to inform you that your booking with the details below requires rescheduling:</p>

    <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Booking Number:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking['order_number'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">Booking Date:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $booking['created_at']->format('d M Y') }}</td>
        </tr>
    </table>

    <p>To proceed with a new schedule, please click the button below:</p>

    <p style="text-align: center; margin: 20px 0;">
        <a href="{{ route('reschedule.form', $booking['reschedule_token']) }}"
           style="background-color: #0056b3; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
           Reschedule Now
        </a>
    </p>

    <p>If you have any questions or need further assistance, please do not hesitate to contact us.</p>

    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>
