<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require "functions.php";

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {

        echo "<script>
            alert('Data berhasil ditambahkan')
            document.location.href = 'daftar.php';
          </script>";
    } else {

        echo "<script>
            alert('Data gagal ditambahkan');
          </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/tambah.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
</head>

<body>

    <nav>
        <ul>
            <li id="nav-one" class="nav-li"><a href="utama.php">Home</a></li>
            <li class="nav-li"><a href="Daftar.php">Daftar Keluarga</a></li>
        </ul>
    </nav>

    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Tambah Anggota Keluarga</legend>
            <input type="hidden" id="id" name="id">
            <ul>
                <li class="input-li">
                    <label for="nama">Nama : </label> <br>
                    <input type="text" id="nama" name="nama" required>
                </li>
                <li class="input-li">
                    <label for="kode">Kode : </label> <br>
                    <input type="text" id="kode" name="kode" required>
                </li>
                <li class="input-li">
                    <label for="pekerjaan">Pekerjaan : </label> <br>
                    <input type="text" id="pekerjaan" name="pekerjaan" required>
                </li>
                <li class="input-li">
                    <label for="gambar">Gambar : </label> <br>
                    <input type="file" id="gambar" name="gambar" required>
                </li>
                <button type="submit" name="submit">Kirim</button>
            </ul>
        </fieldset>
    </form>

</body>

</html>