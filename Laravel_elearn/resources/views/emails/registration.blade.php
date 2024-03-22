<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Email</title>
</head>
<body>
    <h2>Registration Successful</h2>
    <p>Thank you for registering! Your registration number is: {{ $details['numero_inscription'] }}</p>
    <p>Name: {{ $details['nom'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    <p>Feel free to contact us if you have any questions.</p>
    <p>Best regards,</p>
    <p>Your Organization</p>
</body>
</html>
