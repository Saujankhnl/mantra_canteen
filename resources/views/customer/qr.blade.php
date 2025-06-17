<!DOCTYPE html>
<html>
<head>
    <title>Customer QR Code</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>QR Code for {{ $customer->name }}</h1>
        <div>{!! $qrCode !!}</div>
        <p>Scan this QR code to record transactions.</p>
    </div>
</body>
</html>
