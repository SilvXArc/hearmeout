<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "song_hearmeout";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to the database successfully!";
}

// Query untuk mengambil data dari tabel 'hearmeout_database'
$sql = "SELECT * FROM hearmeout_database";
$result = $conn->query($sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hearmeout!</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="mainlogo"><img src ="assets/img/logo.png" class="logo-img"></div>
        <nav>
            <ul>
                <li><a href="#">Submit</a></li>
                <li><a href="#">Browse</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </nav>
    </header>

    <div class="image-container">
                <div class="container_carousel">
                    <div class="scroll-container">
                        <div class="carousel-primary">
                            <img src="assets/img/graduationkanyewest.jpg" alt="albumcover1"> <!-- Gambar path diperbaiki -->
                            <img src="assets/img/hue.png" alt="albumcover2">
                            <img src="assets/img/livingillenium.jpg" alt="albumcover3">
                            <img src="assets/img/peachprincess.jpg" alt="albumcover4">
                        </div>
                        <div class="carousel-primary carousel-secondary">
                            <img src="assets/img/Sleeping_Pink_Noise.png" alt="albumcover5">
                            <img src="assets/img/tokillalvingbookalbum.jpg" alt="albumcover6">
                            <img src="assets/img/tylerthecreator1.jpg" alt="albumcover7">
                            <img src="assets/img/watashinoeritage.jpg" alt="albumcover8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <main class="home-content">
        <!-- Konten utama -->
        <div class="sectionsubmit">
            <h2 class="h22">Send a song</h2>
            <div class="main-content">
                <div class="form-container">
                    <form action="submit_data.php" method="POST" enctype="multipart/form-data">
                        <label for="recipient">Recipient:</label>
                        <input type="text" id="recipient" name="recipient" required>
                        
                        <label for="message">Message:</label>
                        <input type="text" name="message" required></textarea>
                        
                        <label for="song">Song URL:</label>
                        <input type="url" id="song" name="song" required>
                        
                        <button type="submit">Send</button>
                    </form>
                </div>
                <div class="image-preview">
                    <label for="imageInput" class="image-label">
                        <div class="image-placeholder">
                            <p>Click to select or take a photo</p>
                        </div>
                        <input type="file" id="imageInput" accept="image/*" style="display: none;">
                    </label>
                    <div class="speech-bubble">heilou</div>
                </div>
            </div>

            </div>
        </div>

        <div class="warning">
            <p class="heading">Information!</p>
            <p class="word">Share your message with care! Please avoid including any sensitive or personal information like phone numbers, addresses, or private details. Please use appropriate language.</p>
        </div>
        </div>

        
    </main>
    <!-- Bagian untuk menampilkan data dari database -->
    <div class="submitted-songs">
            <h2>Submitted Songs</h2>
            <div id="message-container">
                <div class = "smc">
                    <div class = "carousel-message"> 
                        <?php
                        // Mengecek apakah ada data di database
                        if ($result->num_rows > 0) {
                            // Loop untuk menampilkan setiap data
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='message-card'>";
                                echo "<h3>To: " . $row['recipient'] . "</h3>";
                                echo "<p>Message: " . $row['message'] . "</p>";
                                echo "<a href='" . $row['song'] . "' target='_blank'>View Song</a>";
                                echo "<p>Image: <img src='" . $row['image_path'] . "' alt='Image'></p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No messages found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
    </div>

    <script src="assets/js/scripts.js"></script>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
