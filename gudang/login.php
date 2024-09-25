<?php
include('proses.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #121212;
            font-family: Arial, sans-serif;
            color: #ffffff;
        }
        .card {
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #ffffff;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #444444;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #333333;
            color: #ffffff;
        }
        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #aaaaaa;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <form action="proses.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
