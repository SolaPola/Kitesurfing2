<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Cancelled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #06B6D4;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Kitesurfing Lesson Cancellation</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $booking->user->firstname }},</p>
        
        <p>We're sorry to inform you that your kitesurfing lesson scheduled for <strong>{{ date('l, F j, Y', strtotime($session->lesson_date)) }}</strong> at <strong>{{ date('H:i', strtotime($session->start_time)) }}</strong> has been cancelled.</p>
        
        <p><strong>Cancellation Reason:</strong><br>
        {{ $reason }}</p>
        
        <p>We understand this may be inconvenient and we apologize for any disruption to your plans. Our team will contact you shortly to reschedule your lesson at a more suitable time.</p>
        
        <p>If you have any questions or would like to discuss rescheduling options immediately, please don't hesitate to contact us at support@kitesurfingvs.com or call our customer service at +31 20 123 4567.</p>
        
        <p>Thank you for your understanding.</p>
        
        <p>Best regards,<br>
        KitesurfingVS Team</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} KitesurfingVS. All rights reserved.</p>
        <p>You received this email because you have a booking with KitesurfingVS.</p>
    </div>
</body>
</html>
