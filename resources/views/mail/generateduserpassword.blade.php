<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <p>Dear {{ $username }},</p>

    <p>Your account has been successfully created. Here are your account details:</p>

    <p><strong>Username:</strong> {{ $username }}<br>
    <strong>Email:</strong> {{ $email }}<br>
    <strong>Password:</strong> {{ $password }}</p>

    <p>Please log in and change your password as soon as possible for security purposes.</p>

    <p>If you did not request this account or believe you received this email in error, please disregard it and contact us immediately.</p>

    <p>Thank you,<br>
    {{ config('app.name') }} Support Team</p>
</body>
</html>