<?php
include 'koneksi.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Password tidak cocok dengan konfirmasi password.";
    } else {
        $stmt = $koneksi->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $koneksi->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
                header("Location: login.php");
                exit();
            } else {
                $error = "Terjadi kesalahan. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
 * * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background: url('bg1.jpg') no-repeat center center fixed; 
    background-size: cover;
    color: #fff; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    color: #FFCC00; 
}

form {
    background: rgba(0, 0, 0, 0.8);
    padding: 20px;
    border-radius: 10px; 
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    width: 300px; 
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #FFCC00; 
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #FFCC00; 
    border-radius: 5px;
    font-size: 16px; 
    background-color: rgba(255, 255, 255, 0.9); 
    color: #001F3F; 
    transition: border-color 0.3s ease; 
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #FF9900; 
    outline: none; 
}

button {
    background-color: #FF9900; 
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease; 
}

button:hover {
    background-color: #FFCC00; 
}

.error {
    color: #FF0000;
    margin-top: 10px;
}

.register-link {
    margin-top: 15px;
    text-align: center;
}

.register-link a {
    color: #FFCC00; 
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline; 
}

.success {
    color: #00FF00; 
    margin-top: 10px;
}



    </style>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Register</button>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </form>

    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
</body>
</html>
