<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Email Change</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #1f2937;
            font-size: 32px;
            margin: 0;
            font-weight: 700;
        }

        .logo span {
            color: #6b7280;
            font-size: 14px;
            display: block;
            margin-top: 5px;
        }

        .content {
            margin-bottom: 30px;
        }

        .content h2 {
            color: #1f2937;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .content p {
            color: #4b5563;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .new-email {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 18px;
            color: #1f2937;
            text-align: center;
            margin: 20px 0;
            font-weight: 600;
        }

        .button {
            display: inline-block;
            background-color: #111827;
            color: #ffffff !important;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #374151;
        }

        .button-container {
            text-align: center;
        }

        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .warning p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .footer p {
            margin: 5px 0;
        }

        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 30px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">
            <h1>🌟 SMILE</h1>
            <span>Volunteer Management Platform</span>
        </div>

        <div class="content">
            <h2>Confirm Your Email Change</h2>

            <p>Hello!</p>

            <p>You have requested to change your email address to:</p>

            <div class="new-email">
                {{ $newEmail }}
            </div>

            <p>To complete this process and verify your new email address, please click the button below:</p>

            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="button">
                    Confirm Email Change
                </a>
            </div>

            <p style="color: #6b7280; font-size: 14px; text-align: center; margin-top: 15px;">
                Or copy and paste this link into your browser:<br>
                <span style="word-break: break-all; color: #3b82f6;">{{ $verificationUrl }}</span>
            </p>
        </div>

        <div class="divider"></div>

        <div class="warning">
            <p><strong>⚠️ Important Security Notice:</strong></p>
            <p>If you did not request this email change, please ignore this email and your current email address will
                remain unchanged. For security concerns, please contact our support team immediately.</p>
        </div>

        <div class="footer">
            <p><strong>This link will expire in 24 hours.</strong></p>
            <p>Thank you for using SMILE!</p>
            <p style="margin-top: 15px;">&copy; {{ date('Y') }} SMILE. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
