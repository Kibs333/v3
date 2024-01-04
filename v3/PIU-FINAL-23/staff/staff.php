<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="resources/css/style.css">
        <link rel="icon" type="image/png" sizes="192x192" href="../resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../resources/img/favicon-32x32.png">
    <link rel="icon" href="../resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="resources/img/site.webmanifest">
    
    <title>Staff Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            padding: 20px;
        }

        .login-container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .login-button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #45a049;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Staff Login</h2>
        <form class="login-form" action="staff_handler.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <p class="footer">© 2023 pioneer International University</p>
    </div>
</body>
</html>
