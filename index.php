<?php
session_start();
// Menyambungkan ke database
include "koneksi.php"; 

$error = "";

if (isset($_POST['login'])) {
    // Mengamankan input email dan password
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; 
    
    // Mengecek ketersediaan user di database
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika data cocok, simpan email di session dan pindah ke halaman kamera
        $_SESSION['user_email'] = $email;
        header("Location: camera.html");
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
    <title>Amphi's Photobooth</title>

    <link rel="stylesheet" href="index.css">
</head>

<body>

<div class="container">

    <h1 class="title">📸 Amphi's Photobooth</h1>

    <div class="camera-box">
        Camera Preview
    </div>

    <a href="camera.html" class="btn">
        Mulai Foto
    </a>

</div>

</body>
</html>