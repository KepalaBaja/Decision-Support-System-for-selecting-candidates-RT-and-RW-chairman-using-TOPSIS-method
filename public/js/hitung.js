// Menjalankan fungsi ketika halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
    // Mengambil elemen tombol hitung
    var tombolHitung = document.querySelector("#tombol-hitung");

    // Mengambil jumlah data calon
    var jumlahDataCalon = document.querySelectorAll('.data-calon').length;

    // Menyembunyikan tombol hitung jika jumlah data calon kurang dari 2
    if (jumlahDataCalon < 2) {
        tombolHitung.style.display = "none";
        // Menampilkan pop-up peringatan
        alert("Maaf, isi terlebih dahulu data calon minimal 2");
    }
});
