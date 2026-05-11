document.getElementById('regForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm_password').value;

    if (password !== confirm) {
        e.preventDefault(); // Batalkan pengiriman form
        alert("Konfirmasi password tidak sesuai!");
    }

    if (password.length < 5) {
        e.preventDefault();
        alert("Password minimal harus 5 karakter!");
    }
});