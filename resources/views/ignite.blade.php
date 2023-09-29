<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Code To Log Attendance</title>
    <style>
        body {
            background-color: white;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .content {
            text-align: center;
        }
        
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        
        h1 {
            color: teal;
            margin: 0;
            padding: 20px;
        }

        #qr-code {
            margin: 20px auto;
            /* You can generate your QR code and replace the background image URL here */
            background-image: url('your-qr-code-image.png');
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div id="qr-code">
                {!! $qrcode !!}
            </div>
        </div>
    </div>
</body>
</html>
