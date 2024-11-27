
document.addEventListener("DOMContentLoaded", () => {
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
});
