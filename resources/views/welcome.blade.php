<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Mantra Canteen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    :root {
      --primary-color: #0d6efd;
      --accent-color: #00bcd4;
      --white: #ffffff;
      --bg-glass: rgba(255, 255, 255, 0.1);
      --blur: blur(10px);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(-45deg, #0d6efd, #00bcd4, #6610f2, #17c1e8);
      background-size: 400% 400%;
      animation: gradientShift 10s ease infinite;
      color: var(--white);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .splash {
      background: var(--bg-glass);
      backdrop-filter: var(--blur);
      border-radius: 20px;
      padding: 40px 60px;
      text-align: center;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      animation: zoomIn 1.2s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes zoomIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    .splash h1 {
      font-size: 48px;
      font-weight: bold;
      margin-bottom: 10px;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
    }

    .typewriter-text {
      font-size: 20px;
      white-space: nowrap;
      overflow: hidden;
      width: 32ch; /* Fits approx. 32 characters */
      animation: typing 3s steps(32, end) forwards, blink 0.7s step-end infinite;
      border-right: 2px solid white;
      margin: 0 auto 20px;
    }

    @keyframes typing {
      from { width: 0; }
      to { width: 32ch; }
    }

    @keyframes blink {
      0%, 100% { border-color: transparent; }
      50% { border-color: white; }
    }

    .loader {
      border: 6px solid rgba(255, 255, 255, 0.3);
      border-top: 6px solid #fff;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      margin: 20px auto;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .footer-msg {
      font-size: 16px;
      margin-top: 10px;
      opacity: 0.85;
      animation: fadeIn 1.5s ease 3s forwards;
    }

    @keyframes fadeIn {
      to { opacity: 1; }
    }

    .logo {
      width: 80px;
      height: 80px;
      margin-bottom: 20px;
      border-radius: 50%;
      border: 2px solid white;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
    }

    @media screen and (max-width: 480px) {
      .splash {
        padding: 30px 20px;
      }
      .splash h1 {
        font-size: 32px;
      }
      .typewriter-text {
        font-size: 16px;
        width: 30ch;
        animation: typing 3s steps(30, end) forwards, blink 0.7s step-end infinite;
      }
    }
  </style>

  <script>
    setTimeout(function () {
      window.location.href = "{{ url('/english') }}"; // Replace with actual route
    }, 6000);
  </script>
</head>

<body>
  <div class="splash">
    <img src="https://img.icons8.com/fluency/96/meal.png" alt="Canteen Logo" class="logo" />
    <h1>Welcome to Mantra Canteen</h1>
    <p class="typewriter-text">Delicious & Hygienic Food Awaits You.</p>
    <div class="loader" role="status" aria-label="Loading animation"></div>
    <p class="footer-msg">Redirecting to main app...</p>
  </div>
</body>
</html>
