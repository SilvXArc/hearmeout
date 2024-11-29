<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "song_hearmeout";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$recipient = $_POST['recipient'];
$message = $_POST['message'];
$song = $_POST['song'];

// Menangani upload gambar (jika ada)
$image_path = "";
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image_path = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Simpan file ke folder 'uploads'
}

// Menyimpan data ke tabel
$sql = "INSERT INTO hearmeout_database (recipient, message, song, image_path) 
        VALUES ('$recipient', '$message', '$song', '$image_path')";

// Mengeksekusi query
if ($conn->query($sql) === TRUE) {
    // Jika sukses, alihkan ke index.html
    header("Location: index.php");
    exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
