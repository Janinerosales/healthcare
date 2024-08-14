<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>One-Time Pin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      text-align: center;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .otp-title {
      font-size: 1.5em;
      margin-bottom: 10px;
      color: #333;
    }

    .otp-code {
      font-size: 2em;
      font-weight: bold;
      color: #007BFF;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="otp-title">Your One-Time Pin</div>
    <div class="otp-code">{{$otp}}</div>
  </div>
</body>

</html>