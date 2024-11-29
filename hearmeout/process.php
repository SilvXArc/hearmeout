<?php
ob_start(); // Memulai output buffering
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = htmlspecialchars($_POST['recipient']);
    $message = htmlspecialchars($_POST['message']);
    $song = htmlspecialchars($_POST['song']);
    $uploadDir = 'uploads/';
    $uploadedFile = '';

    // Handle file upload
    if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES['imageInput']['name']);
        $fileTmpPath = $_FILES['imageInput']['tmp_name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadedFile = $uploadDir . uniqid() . '.' . $fileExtension;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            if (!move_uploaded_file($fileTmpPath, $uploadedFile)) {
                header("Location: index.html?status=upload_error");
                exit;
            }
        } else {
            header("Location: index.html?status=invalid_file");
            exit;
        }
    }

    // Simpan data ke dalam file atau database
    $data = "Recipient: $recipient\nMessage: $message\nSong: $song\nImage Path: $uploadedFile\n\n";
    if (!file_put_contents('data.txt', $data, FILE_APPEND)) {
        header("Location: index.html?status=save_error");
        exit;
    }

    // Debugging: pastikan data sudah disimpan
    echo 'Data telah disimpan: ';
    echo $data;
    
    // Redirect ke index.html dengan status sukses
    header("Location: index.html?status=success");
    exit;
} else {
    header("Location: index.html");
    exit;
}

ob_end_flush();
?>
