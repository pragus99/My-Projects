<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require "functions.php";

$jumlahPerhalaman = 4;
$jumlahData = count(query("SELECT * FROM keluarga"));
$jumlahHalaman = ceil($jumlahData / $jumlahPerhalaman);
$halamanAktif = (isset($_GET["p"])) ? $_GET["p"] : 1;
$awalData = ($jumlahPerhalaman * $halamanAktif) - $jumlahPerhalaman;


$keluarga = query("SELECT * FROM keluarga LIMIT $awalData, $jumlahPerhalaman");

//cari
if (isset($_POST["cari"])) {
    $keluarga = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="css/daftar.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Keluarga</title>
</head>

<body>
    <nav>
        <ul>
            <li id="nav-one" class="nav-li"><a href="utama.php">Home</a></li>
            <li class="nav-li"><a href="tambah.php">Tambah Anggota</a></li>
        </ul>
    </nav>

<div class="wrapper">
    <h1>Daftar Keluarga</h1>

    <form action="" method="POST">
        <input type="text" name="keyword" size="30" autofocus placeholder="Ketik kata kunci pencarian..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>
    </form>
    <br>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>No</th>
                <th class="aksi">Aksi</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Pekerjaan</th>
            </tr>

            <?php $no = 1; ?>
            <?php foreach ($keluarga as $klg) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td class="aksi">
                        <a href="ubah.php?id=<?php echo $klg["id"]; ?>" class="ubah">Ubah</a> |
                        <a href="hapus.php?id=<?php echo $klg["id"]; ?>" class="hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                    <td><img src="img/<?php echo $klg["gambar"]; ?>" width="50" height="50"></td>
                    <td><?php echo $klg["nama"]; ?></td>
                    <td><?php echo $klg["kode"]; ?></td>
                    <td><?php echo $klg["pekerjaan"]; ?></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>

        </table>
    </div>
    
    <br>

    <?php if (!isset($_POST["cari"])) : ?>
        <?php if ($halamanAktif > 1) : ?>
            <a href="?p=<?php echo $halamanAktif - 1; ?>">&lt;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="?p=<?php echo $halamanAktif + 1; ?>">&gt;</a>
        <?php endif; ?>
    <?php endif; ?>

    </div>
    <script src="js/script.js"></script>
</body>

</html>