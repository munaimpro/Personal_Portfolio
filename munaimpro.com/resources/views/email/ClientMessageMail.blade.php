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
            
            <p>{!! $clientMessage !!}</p>
            
            <p>If you have any questions or need further clarification, please feel free to reach out to me directly.</p>
            
            <a href="[Your CTA Link Here]" class="cta-button">Take Action Now</a>
        </div>
        <div class="footer">
            <p>Thank you for your attention, and I look forward to your response.</p>
            
            <p>Best regards,<br>
            <strong>[Your Full Name]</strong><br>
            [Your Job Title]<br>
            [Your Company Name]</p>
            
            <div class="social-icons">
                <a href="your-facebook-link-here"><img src="facebook-icon-url" alt="Facebook"></a>
                <a href="your-twitter-link-here"><img src="twitter-icon-url" alt="Twitter"></a>
                <a href="your-linkedin-link-here"><img src="linkedin-icon-url" alt="LinkedIn"></a>
            </div>
            
            <p class="footer-note">If you no longer wish to receive emails from us, please <a href="[Unsubscribe Link]">unsubscribe here</a>.</p>
        </div>
    </div>
</body>
</html>