<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        /* Basic Reset */
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
            background-color: #A08C8DFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
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

        .button {
            display: inline-block;
            /* background-color: #A08C8DFF; */
            color: #33333;
            padding: 12px 20px;
            text-decoration: underline;
            border-radius: 5px;
            font-size: 16px;
        }

        .footer {
            background-color: #A08C8DFF;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #ffffff;
        }

        .footer a {
            color: #A08C8DFF;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>

        <div class="content">
            <p>Hi there,</p>
            <p>You recently requested to reset your password. Click the button below to reset it:</p>
            <a href="{{ route('auth.reset.password') }}?token={{ $token ?? '' }}&email={{ $email ?? ''}}" class="button">Reset Password</a>
            <p>If you didn't request a password reset, you can safely ignore this email.</p>
        </div>

        <div class="footer">
            <p>&copy;{{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.</p>
        </div>
    </div>

</body>

</html>