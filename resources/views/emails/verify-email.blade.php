<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to KitesurfingVS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #111827;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            color: #06B6D4;
            margin: 0;
        }

        .content {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }

        .btn {
            display: inline-block;
            background-color: #06B6D4;
            color: #111827;
            font-weight: bold;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>KitesurfingVS</h1>
        </div>
        <div class="content">
            <h2>Hello {{ $user->firstname ?: 'there' }}!</h2>
            <p>Welcome to KitesurfingVS! We're excited to have you join our community of kitesurfing enthusiasts.</p>
            <p>To complete your registration and activate your account, please click the button below:</p>

            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="btn">Activate Account</a>
            </div>

            <p>During activation, you'll set up your password and complete your profile.</p>
            <p>If you did not create an account, no further action is required.</p>
            <p>Thank you for choosing KitesurfingVS for your kitesurfing adventures!</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} KitesurfingVS. All rights reserved.</p>
            <p>If you're having trouble clicking the "Activate Account" button, copy and paste the URL below into your
                web browser:</p>
            <p>{{ $verificationUrl }}</p>
        </div>
    </div>
</body>

</html>
