<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/welcomephp.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        Selamat datang, Admin.
        <br>
        <ul>
        <li><a href="daftar.php">Daftar Anggota Keluarga</a></li>
        <li><a href="tambah.php">Tambah Anggota Kelurga</a></li>
        <li><a href="logout.php" onclick="return confirm('Yakin hapus?')">Logout</a></li>
        </ul>
    </div>
</body>

</html>