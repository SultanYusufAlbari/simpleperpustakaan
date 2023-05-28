<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root'; // Ganti dengan username MySQL Anda
$password = ''; // Ganti dengan password MySQL Anda
$database = 'perpustakaan';

$koneksi = mysqli_connect($host, $username, $password, $database);
if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

//==========================================

// Fungsi untuk menampilkan semua data anggota
function tampilkanAnggota()
{
    global $koneksi;
    $query = "SELECT * FROM anggota";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID Anggota</th><th>Nama</th><th>Alamat</th><th>Kota</th><th>No. Telephone</th><th>Tanggal Lahir</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_anggota'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['kota'] . "</td>";
            echo "<td>" . $row['no_telephone'] . "</td>";
            echo "<td>" . $row['tanggal_lahir'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data anggota.";
    }
}

// Fungsi untuk menambah data anggota
function tambahAnggota($nama, $alamat, $kota, $no_telephone, $tanggal_lahir)
{
    global $koneksi;
    $query = "INSERT INTO anggota (nama, alamat, kota, no_telephone, tanggal_lahir) VALUES ('$nama', '$alamat', '$kota', '$no_telephone', '$tanggal_lahir')";
    if (mysqli_query($koneksi, $query)) {
        echo "Data anggota berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan data anggota: " . mysqli_error($koneksi);
    }
}

// Fungsi untuk mengubah data anggota
function ubahAnggota($id_anggota, $nama, $alamat, $kota, $no_telephone, $tanggal_lahir)
{
    global $koneksi;
    $query = "UPDATE anggota SET nama='$nama', alamat='$alamat', kota='$kota', no_telephone='$no_telephone', tanggal_lahir='$tanggal_lahir' WHERE id_anggota=$id_anggota";
    if (mysqli_query($koneksi, $query)) {
        echo "Data anggota berhasil diubah.";
    } else {
        echo "Gagal mengubah data anggota: " . mysqli_error($koneksi);
    }
}

// Fungsi untuk menghapus data anggota
function hapusAnggota($id_anggota)
{
    global $koneksi;
    $query = "DELETE FROM anggota WHERE id_anggota=$id_anggota";
    if (mysqli_query($koneksi, $query)) {
        echo "Data anggota berhasil dihapus.";
    } else {
        echo "Gagal menghapus data anggota: " . mysqli_error($koneksi);
    }
}

//==============
// Fungsi untuk mendapatkan semua buku
function getAllBuku()
{
    global $koneksi;
    $query = "SELECT * FROM buku";
    $result = mysqli_query($koneksi, $query);
    $buku = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $buku;
}

// Fungsi untuk mendapatkan detail buku berdasarkan No Buku
function getBukuByNo($no)
{
    global $koneksi;
    $query = "SELECT * FROM buku WHERE no_buku = '$no'";
    $result = mysqli_query($koneksi, $query);
    $buku = mysqli_fetch_assoc($result);
    return $buku;
}

// Fungsi untuk menambah buku baru
function tambahBuku($data)
{
    global $koneksi;
    $no_buku = $data['no_buku'];
    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $tahun_terbit = $data['tahun_terbit'];
    $jenis_buku = $data['jenis_buku'];
    $status = $data['status'];

    $query = "INSERT INTO buku (no_buku, judul, pengarang, tahun_terbit, jenis_buku, status) VALUES ('$no_buku', '$judul', '$pengarang', '$tahun_terbit', '$jenis_buku', '$status')";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk mengupdate buku
function updateBuku($data)
{
    global $koneksi;
    $no_buku = $data['no_buku'];
    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $tahun_terbit = $data['tahun_terbit'];
    $jenis_buku = $data['jenis_buku'];
    $status = $data['status'];

    $query = "UPDATE buku SET judul='$judul', pengarang='$pengarang', tahun_terbit='$tahun_terbit', jenis_buku='$jenis_buku', status='$status' WHERE no_buku='$no_buku'";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus buku berdasarkan No Buku
function hapusBuku($no)
{
    global $koneksi;
    $query = "DELETE FROM buku WHERE no_buku='$no'";
    mysqli_query($koneksi, $query);
}

//==============

// Fungsi untuk mendapatkan semua data peminjaman
function getAllPeminjaman()
{
    global $koneksi;
    $query = "SELECT * FROM pinjam";
    $result = mysqli_query($koneksi, $query);
    $peminjaman = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $peminjaman;
}

// Fungsi untuk mendapatkan detail peminjaman berdasarkan No Pinjam
function getPeminjamanByNo($no)
{
    global $koneksi;
    $query = "SELECT * FROM pinjam WHERE no_pinjam = '$no'";
    $result = mysqli_query($koneksi, $query);
    $peminjaman = mysqli_fetch_assoc($result);
    return $peminjaman;
}

// Fungsi untuk menambah data peminjaman baru
function tambahPeminjaman($data)
{
    global $koneksi;
    $id_anggota = $data['id_anggota'];
    $no_buku = $data['no_buku'];
    $no_pinjam = $data['no_pinjam'];
    $tanggal_pinjam = $data['tanggal_pinjam'];
    $tanggal_kembali = $data['tanggal_kembali'];

    $query = "INSERT INTO pinjam (no_pinjam, id_anggota, no_buku, tanggal_pinjam, tanggal_kembali) VALUES ('$no_pinjam', '$id_anggota', '$no_buku', '$tanggal_pinjam', '$tanggal_kembali')";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk mengupdate data peminjaman
function updatePeminjaman($data)
{
    global $koneksi;
    $no_pinjam = $data['no_pinjam'];
    $id_anggota = $data['id_anggota'];
    $no_buku = $data['no_buku'];
    $tanggal_pinjam = $data['tanggal_pinjam'];
    $tanggal_kembali = $data['tanggal_kembali'];

    $query = "UPDATE pinjam SET tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali', id_anggota='$id_anggota', no_buku='$no_buku' WHERE no_pinjam='$no_pinjam'";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus data peminjaman berdasarkan No Pinjam
function hapusPeminjaman($no)
{
    global $koneksi;
    $query = "DELETE FROM pinjam WHERE no_pinjam='$no'";
    mysqli_query($koneksi, $query);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
