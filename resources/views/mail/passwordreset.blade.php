<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Notification</title>
</head>
<body>
    <p>Dear {{ $username }},</p>

    <p>This is to inform you that an administrator has reset your password. To regain access to your account, please follow the steps below to reset your password:</p>

    <p><strong>Forget Code:</strong> {{ $forgetCode }}</p>

    <p><strong>Reset Password Link:</strong> <a href="{{ url('/reset-password') }}">{{ url('/reset-password') }}</a></p>

    <p>For your security, please ensure that you reset your password as soon as possible. The reset code will expire in 3 days.</p>

    <p>If you did not request this reset or have any questions, please contact our support team immediately.</p>

    <p>Thank you,<br>
    {{ config('app.name') }} Support Team</p>
</body>
</html>
