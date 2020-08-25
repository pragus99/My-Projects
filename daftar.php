<?php
require "functions.php";
$keluarga = query("SELECT * FROM keluarga");

//cari
if ( isset($_POST["cari"]) ) {
    $keluarga = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Keluarga</title>
</head>

<body>
<h3><a href="utama.php">Home</a></h3>
    <h1>Daftar Keluarga</h1>

<form action="" method="POST">
    <input type="text" name="keyword" size="30" autofocus placeholder="Ketik kata kunci pencarian..." autocomplete="off">
    <button type="submit" name="cari">Cari!</button>
</form>
<br>

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Pekerjaan</th>
        </tr>

        <?php $no = 1; ?>
        <?php foreach($keluarga as $klg) : ?>
        <tr>
            <td><?= $no; ?></td>
            <td>
                <a href="ubah.php?id=<?php echo $klg["id"];?>">Ubah</a> |
                <a href="hapus.php?id=<?php echo $klg["id"];?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
            <td><img src="img/<?php echo $klg["gambar"];?>" width="50" height="30"></td>
            <td><?php echo $klg["nama"]; ?></td>
            <td><?php echo $klg["kode"]; ?></td>
            <td><?php echo $klg["pekerjaan"]; ?></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
        
    </table>
</body>

</html>