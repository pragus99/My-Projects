<?php

// terhubung database
$conn = mysqli_connect('localhost', 'root', '', 'phpadmin');

// terhubung table dalam database dan mengambil setiap baris
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $kotak = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $kotak[] = $row;
    }
    return $kotak;
}

//  menambahkan data anggota keluarga
function tambah($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $kode = htmlspecialchars($data["kode"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $gambar = htmlspecialchars($data["gambar"]);
    
    // cek gambar
    // if ( !isset($_FILES("gambar")) ) {
    //     return false;
    // }

    $query = "INSERT INTO keluarga VALUES 
            ('', '$nama', '$kode', '$pekerjaan', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
     
}

// Hapus anggota keluarga
function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM keluarga WHERE id = $id");

    return mysqli_affected_rows($conn);
}


// Mengubah data anggota keluarga
function ubah($data) {
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $kode = htmlspecialchars($data["kode"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $gambar = htmlspecialchars($data["gambar"]);

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
function cari($keyword) {
    $query = "SELECT * FROM keluarga WHERE 
            nama LIKE '%$keyword%' OR
            kode LIKE '%$keyword%' OR
            pekerjaan LIKE '%$keyword%'
            ";

    return query($query);
}

?>