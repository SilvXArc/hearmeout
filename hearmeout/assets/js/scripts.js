document.addEventListener("DOMContentLoaded", () => {
    // Image input preview logic
    const imageInput = document.getElementById("imageInput");
    const imagePreview = document.querySelector(".image-preview");

    imageInput.addEventListener("change", (event) => {
        const file = event.target.files[0]; // Ambil file yang dipilih
        if (file) {
            const reader = new FileReader(); // Membuat FileReader untuk membaca file
            reader.onload = (e) => {
                // Menampilkan gambar baru sebagai pratinjau
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file); // Membaca file sebagai URL data
        }
    });

    // Klik ulang untuk mengganti gambar
    imagePreview.addEventListener("click", () => {
        imageInput.click(); // Simulasikan klik pada input file
    });

    const messageContainer = document.getElementById('message-container');

    // Fetch data dari PHP
    fetch('get_data.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Loop untuk menampilkan data
                data.forEach(entry => {
                    const card = document.createElement('div');
                    card.className = 'message-card';
                    card.innerHTML = `
                        <h3>To: ${entry['recipient'] || 'Unknown'}</h3>
                        <p>${entry['message'] || 'No message provided'}</p>
                        <div class="song">
                            <img src="${entry['image_path'] || 'default-image.jpg'}" alt="Song Image">
                            <div class="song-title">
                                <a href="${entry['song'] || '#'}" target="_blank">
                                    ${entry['song'] ? 'View Song' : 'No Song Link'}
                                </a>
                            </div>
                        </div>
                    `;
                    messageContainer.appendChild(card);
                });
            } else {
                messageContainer.innerHTML = '<p>No messages found!</p>';
            }
        })
        .catch(error => console.error('Error loading data:', error));
});