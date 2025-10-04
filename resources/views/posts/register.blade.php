<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
    body {
      margin: 0; padding: 0;
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      display: flex; justify-content: center; align-items: center;
      height: 100vh;
    }
    .register-box {
      width: 350px; padding: 40px;
      background: #fff;
      box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
      border-radius: 10px;
      text-align: center;
    }
    .register-box img {
      width: 80px; margin-bottom: 20px;
    }
    .register-box input {
      width: 100%; padding: 12px; margin: 10px 0;
      border: 1px solid #ccc; border-radius: 5px;
      outline: none; font-size: 14px;
    }
    .register-box button {
      width: 100%; padding: 12px;
      background: #28a745;
      border: none; border-radius: 5px;
      color: #fff; font-size: 16px; cursor: pointer;
    }
    .register-box button:hover {
      background: #1e7e34;
    }
    .register-box p {
      margin-top: 15px; font-size: 14px;
    }
    .register-box p a {
      color: #007bff; text-decoration: none;
    }
    .register-box p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828506.png" alt="Register Icon">

<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
</form>
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
  </div>
</body>
</html>
