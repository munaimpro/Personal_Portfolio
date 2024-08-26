<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 150px;
        }
        .body-content {
            margin: 20px 0;
        }
        .cta-button {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 30px;
        }
        .social-icons img {
            width: 24px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="your-logo-url-here" alt="Company Logo">
        </div>
        <div class="body-content">
            <p>Dear [Recipient's Name],</p>
            
            <p>{!! $adminMessage !!}</p>
            
            <p>If you have any questions or need further clarification, please feel free to reach out to me directly.</p>
            
            <a href="[Your CTA Link Here]" class="cta-button">Take Action Now</a>
        </div>
        <div class="footer">
            <p>Thank you for your attention, and I look forward to your response.</p>
            
            <p>Best regards,<br>
                <strong>{{ $fullName }}</strong>
                <br>{{ $designation }}<br>
                {{-- [Your Company Name] --}}
            </p>
            
            <div class="social-icons">
                <a href="{{ $facebookLink }}"><img src="{{ asset('assets/img/icons/facebook.png') }}" alt="Facebook"></a>
                <a href="{{ $linkedinLink }}"><img src="{{ asset('assets/img/icons/linkedin.png') }}" alt="LinkedIn"></a>
            </div>
        </div>
    </div>
</body>
</html>