<?php
session_start();
// Menghubungkan ke database melalui file koneksi
include "../koneksi.php"; 

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Mencari user di database
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user_email'] = $email;
        // Jika berhasil, pindah ke halaman kamera
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Email atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Amphi's Photobooth</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>📸 Login</h1>
            
            <?php if($error != ""): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>

            <form class="login-form" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login" class="btn-submit">MASUK</button>
            </form>

            <div class="footer-links">
                <p>Belum punya akun? <a href="../register/register.php">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>