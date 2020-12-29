<?php
require "functions.php";

 if ( isset($_POST["regis"]) ) {
    if (regis($_POST) > 0) {
         echo "<script>
                alert('Pengguna baru berhasil ditambahkan');
                </script>";
     } else {
         echo mysqli_error($conn);
     }
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/welcome.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>

<body>
    <h1>Registrasi</h1>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username : </label> <br>
                <input type="text" id="username" name="username" required>
            </li>
            <li>
                <label for="password">Password : </label> <br>
                <input type="password" id="password" name="password" required>
            </li>
            <li>
                <label for="password2">Konfirm password : </label> <br>
                <input type="password" id="password2" name="password2" required>
            </li>
        </ul>
        <button type="submit" name="regis">Registrasi!</button>
        <p>punya akun?<a href="index.php">Kesini!</a></p>
    </form>
</body>

</html>