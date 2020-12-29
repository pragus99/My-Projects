<?php
require "../functions.php";
$keyword = $_GET["keyword"];

$query = "SELECT * FROM keluarga WHERE 
          nama LIKE '%$keyword%' OR
          kode LIKE '%$keyword%' OR
          pekerjaan LIKE '%$keyword%'
          ";

$keluarga = query($query);

?>

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
<?php foreach ($keluarga as $klg) : ?>
    <tr>
        <td><?= $no; ?></td>
        <td>
            <a href="ubah.php?id=<?php echo $klg["id"]; ?>">Ubah</a> |
            <a href="hapus.php?id=<?php echo $klg["id"]; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
        <td><img src="img/<?php echo $klg["gambar"]; ?>" width="50" height="50"></td>
        <td><?php echo $klg["nama"]; ?></td>
        <td><?php echo $klg["kode"]; ?></td>
        <td><?php echo $klg["pekerjaan"]; ?></td>
    </tr>
    <?php $no++; ?>
<?php endforeach; ?>

</table>