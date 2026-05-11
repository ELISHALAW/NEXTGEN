<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic reset for email clients */
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f8fafc; padding: 40px 0; }
        .content { width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 20px; margin: 0 auto; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(to bottom right, #2563eb, #4338ca); padding: 40px; text-align: center; color: #ffffff; }
        .body { padding: 40px; text-align: center; }
        .button { background-color: #2563eb; color: #ffffff !important; padding: 16px 32px; text-decoration: none; border-radius: 12px; font-weight: bold; display: inline-block; margin: 25px 0; }
        .footer { padding: 20px; text-align: center; color: #64748b; font-size: 12px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                <h1 style="margin:0; font-size: 24px;">Security First</h1>
                <p style="opacity: 0.8;">Protecting your account</p>
            </div>

            <div class="body">
                <h2 style="color: #1e293b;">Hello, {{ $name }}!</h2>
                <p style="color: #475569; line-height: 1.6;">
                    Thanks for signing up! Verifying your email keeps your account safe and lets you use the full site. 
                    Please click the button below to verify your email address.
                </p>
                
                <a href="{{ $url }}" class="button">Verify Email Address</a>
                
                <p style="color: #94a3b8; font-size: 14px; margin-top: 20px;">
                    If you did not create an account, no further action is required.
                </p>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>