<?php

// terhubung database
// $conn = mysqli_connect('sql305.epizy.com', 'epiz_26613537', 'MJcWXmrdkF', 'epiz_26613537_mulaiphp');
$conn = mysqli_connect('localhost', 'root', '', 'mulaiphp');


// terhubung table dalam database dan mengambil setiap baris
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $kotak = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kotak[] = $row;
    }
    return $kotak;
}

//  menambahkan data anggota keluarga
function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $kode = htmlspecialchars($data["kode"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO keluarga VALUES 
            ('', '$nama', '$kode', '$pekerjaan', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// upload gambar
function upload()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek upload gambar
    if ($error === 4) {
        echo "<script>
                alert('Wajib pilih gambar!');
              </script>";
        return false;
    }

    //cek ekstensi
    $ekstensiValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));


    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        echo "<script>
                alert('Wajib pilih file gambar!');
              </script>";
        return false;
    }
    //menghasilkan nama acak
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    //cek ukuran
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}



// Hapus anggota keluarga
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM keluarga WHERE id = $id");

    return mysqli_affected_rows($conn);
}


// Mengubah data anggota keluarga
function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $kode = htmlspecialchars($data["kode"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE keluarga SET 
                nama = '$nama', 
                kode = '$kode', 
                pekerjaan = '$pekerjaan', 
                gambar = '$gambar' 
                WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// Cari data anggota keluarga
function cari($keyword)
{
    $query = "SELECT * FROM keluarga WHERE 
            nama LIKE '%$keyword%' OR
            kode LIKE '%$keyword%' OR
            pekerjaan LIKE '%$keyword%'
            ";

    return query($query);
}

// Registrasi admin
function regis($data) {
    global $conn;

    $user = strtolower(stripslashes($data["username"]));
    $pass = mysqli_real_escape_string($conn, $data["password"]);
    $pass2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result= mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$user'");

    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('Username sudah dipakai');
                </script>";
                return false;
    }

    //cek kedua password
    if ( $pass !== $pass2 ) {
        echo "<script>
             alert('Password tidak cocok');
             </script>";
             return false;
    }

    //enkripsi
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO pengguna VALUES ('','$user', '$pass')");

    return mysqli_affected_rows($conn);
}