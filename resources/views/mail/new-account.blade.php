<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Credentials</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .credential-card {
      max-width: 400px;
      margin: auto;
      margin-top: 50px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .credential-header {
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .credential-item {
      margin-bottom: 15px;
    }

    .credential-label {
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="card credential-card">
    <div class="card-body">
      <div class="credential-header">Your Credentials</div>
      <div class="credential-item">
        <div class="credential-label">Email:</div>
        <div>{{$email}}</div>
      </div>
      <div class="credential-item">
        <div class="credential-label">Password:</div>
        <div>{{$password}}</div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>