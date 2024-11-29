<?php
// Baca isi file data.txt
$file = 'data.txt';
if (file_exists($file)) {
    $data = file_get_contents($file);
    echo nl2br($data); // Menampilkan isi file dan mempertahankan format baris
} else {
    echo "File tidak ditemukan.";
}
?>