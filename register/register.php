<?php
include "../koneksi.php";

$message = "";
if (isset($_POST['register'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Password tidak cocok!";
    } else {
        // Cek apakah email sudah ada di database
        $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check_user) > 0) {
            $message = "Email sudah terdaftar!";
        } else {
            // Simpan user baru ke database
            $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='../login/login.php';</script>";
            } else {
                $message = "Terjadi kesalahan sistem.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Amphi's Photobooth</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <div class="register-box">
            <h1>📝 Register</h1>
            <?php if($message != ""): ?>
                <div style="color: red; margin-bottom: 10px; font-weight: bold;"><?php echo $message; ?></div>
            <?php endif; ?>
            <form class="register-form" method="POST" id="regForm">
                <input type="email" name="email" id="email" placeholder="Email Baru" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Ulangi Password" required>
                <button type="submit" name="register" class="btn-register">DAFTAR SEKARANG</button>
            </form>
        </div>
        <a href="../login/login.php" class="login-link">Sudah punya akun? Login di sini</a>
    </div>

    <script src="register.js"></script>
</body>
</html>