<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Reset and body styling */
        body, table, td {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #28A745;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 26px;
            margin: 0;
        }

        .content {
            padding: 30px;
            text-align: center;
        }

        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .content .highlight {
            font-size: 18px;
            font-weight: bold;
            color: #28A745;
        }

        .content .booking-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            margin: 20px auto;
            width: 80%;
        }

        .content .booking-details p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }

        .button {
            display: inline-block;
            background-color: #28A745;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        .footer {
            background-color: #eeeeee;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }

        .footer a {
            color: #28A745;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="header">
            <h1>Booking Confirmed!</h1>
        </div>

        <div class="content">
            <p>Hi {{ $name ?? '-' }},</p>
            <p>Your booking has been successfully confirmed! We are excited to have you with us.</p>

            <div class="booking-details">
                <p><strong>Booking Details:</strong></p>
                <p><strong>Booking ID:</strong> {{ $id ?? '-' }}</p>
                <p><strong>Date:</strong> {{ $date ?? '-' }}</p>
                <p><strong>Service:</strong> {{ $service ?? '-' }}</p>
            </div>

            <p>You can't cancel booking 24 hours before start</p>
            <p>We look forward to seeing you!</p>
        </div>

        <div class="footer">
            {{-- <p>If you have any questions, feel free to <a href="https://yourwebsite.com/contact">contact us</a>.</p> --}}
            <p>&copy; 2024 {{ env('APP_NAME') }}. All Rights Reserved.</p>
        </div>
    </div>

</body>

</html>