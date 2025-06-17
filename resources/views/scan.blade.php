<!DOCTYPE html>
<html>
<head>
    <title>Scan QR Code</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
        }

        video {
            border-radius: 8px;
            border: 2px solid #007bff;
            background: #000;
        }

        #canvas {
            display: none;
        }

        p {
            font-size: 16px;
            color: #333;
            margin: 15px 0;
        }

        #qr-result {
            font-weight: bold;
            color: #007bff;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn:active {
            transform: scale(0.95);
        }

        /* Add a subtle animation for the video border when scanning */
        @keyframes scanningBorder {
            0% { border-color: #007bff; }
            50% { border-color: #00c4b4; }
            100% { border-color: #007bff; }
        }

        video.scanning {
            animation: scanningBorder 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Scan QR Code</h1>
        <video id="video" width="300" height="300"></video>
        <canvas id="canvas"></canvas>
        <p>Scanned QR Code: <span id="qr-result">None</span></p>
        <button id="start-scan" class="btn">Start Scanning</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script>
        const video = document.getElementById('video');
        const canvasElement = document.getElementById('canvas');
        const canvas = canvasElement.getContext('2d');
        const qrResult = document.getElementById('qr-result');
        const startScanButton = document.getElementById('start-scan');

        startScanButton.addEventListener('click', async () => {
            // Access the device camera
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
            video.srcObject = stream;
            video.play();

            // Add scanning animation class to video
            video.classList.add('scanning');

            // Start scanning
            scanQRCode();
        });

        function scanQRCode() {
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
            const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            if (code) {
                qrResult.textContent = code.data;

                // Stop the video stream
                video.srcObject.getTracks().forEach(track => track.stop());
                video.classList.remove('scanning'); // Remove scanning animation

                // Send the scanned QR token to the backend
                fetch('/transactions/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ qr_token: code.data, amount: 100 }) // Example amount
                })
                .then(response => response.json())
                .then(data => {
                    alert('Transaction recorded successfully!');
                    window.location.href = '/'; // Redirect to the transaction list
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                requestAnimationFrame(scanQRCode);
            }
        }
    </script>
</body>
</html>
