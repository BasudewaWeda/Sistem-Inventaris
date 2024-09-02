<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
</head>
<body>
    <p>Dear {{ $username }},</p>

    <p>We received a request to reset your password. To proceed, please use the following code on the password reset page:</p>

    <p><strong>Forget Code:</strong> {{ $forgetCode }}</p>

    <p>You can reset your password by visiting the link below:</p>

    <p><strong>Password Reset Link:</strong> <a href="http://testbreeze.test/reset-password">http://testbreeze.test/reset-password</a></p>

    <p>Please note that this code is only valid for 3 days. If you do not use the code within this period, you will need to request a new one.</p>

    <p>If you did not request a password reset or believe you received this email in error, please disregard it and contact us immediately.</p>

    <p>Thank you,<br>
    {{ config('app.name') }} Support Team</p>
</body>
</html>
