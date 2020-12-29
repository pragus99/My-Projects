<?php
session_start();

if ( !isset($_GET["id"]) ) {
    echo "<script>
            alert('Anda belum memilih data anggota keluarga!');
            document.location.href = 'daftar.php';
         </script>";
}


if ( !isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

require "functions.php";

//ambil data sebelum diubah
$id = $_GET["id"];
$klg = query("SELECT * FROM keluarga WHERE id = $id")[0];

// cek
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {

        echo "<script>
            alert('Data berhasil diubah')
            document.location.href = 'daftar.php';
          </script>";
    } else {

        echo "<script>
            alert('Data gagal diubah');
            document.location.href = 'daftar.php';
          </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/tambah_ubah.css?v=<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Anggota</title>
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/ubah.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Anggota</title>
</head>

<body>
<nav>
    <ul>
        <li class="nav-li"><a href="utama.php">Home</a></li>
        <li class="nav-li"><a href="Daftar.php">Daftar Keluarga</a></li>
    </ul>
    </nav>

    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Tambah Anggota Keluarga</legend>
            <input type="hidden" name="id" value="<?php echo $klg["id"] ?>">
            <input type="hidden" name="gambarLama" value="<?php echo $klg["gambar"] ?>">
            <ul>
                <li class="input-li">
                    <label for="nama">Nama : </label> <br>
                    <input type="text" id="nama" name="nama" value="<?php echo $klg["nama"] ?>" required>
                </li>
                <li class="input-li">
                    <label for="kode">Kode : </label> <br>
                    <input type="text" id="kode" name="kode" value="<?php echo $klg["kode"] ?>" required>
                </li>
                <li class="input-li">
                    <label for="pekerjaan">Pekerjaan : </label> <br>
                    <input type="text" id="pekerjaan" name="pekerjaan" value="<?php echo $klg["pekerjaan"] ?>" required>
                </li>
                <li class="input-li">
                    <label for="gambar">Gambar : </label> <br>
                    <img src="img/<?php echo $klg["gambar"] ?>"  width="50" height="50"><br>
                    <input type="file" id="gambar" name="gambar">
                </li>
                <button type="submit" name="submit">Kirim</button>
            </ul>
        </fieldset>
    </form>

</body>

</html>