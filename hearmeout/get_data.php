<?php
header('Content-Type: application/json');

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";  // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari tabel 'messages'
$sql = "SELECT * FROM hearmeout_database";
$result = $conn->query($sql);

// Menyusun data dalam format JSON
$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data[] = ['message' => 'No data found.'];
}

// Menutup koneksi
$conn->close();

// Mengembalikan data dalam format JSON
echo json_encode($data);
?>
