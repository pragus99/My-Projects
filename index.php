<?php
require "functions.php";

session_start();

// cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    //cek id
    $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek key
    if ( $key === hash('sha256', $row["username"]) ) {
        $_SESSION["login"] = true;
    }
}

//cek session
if ( isset($_SESSION["login"]) ) {
    header("Location: utama.php");
    exit;
}


if ( isset($_POST["login"]) ) {

    $user = $_POST["username"];
    $pass = $_POST["password"];

    //mencari data sesuai username
    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$user'");
    
    // cek password
    if ( mysqli_num_rows($result) === 1 ) {

        $row = mysqli_fetch_assoc($result);
        if( password_verify($pass, $row["password"]) ) {
            // session
            $_SESSION["login"] = true;

            //cookie
            if ( isset($_POST['remember']) ) {
                setcookie('id', $row['id'], time()+60*60*24*30);
                setcookie('key', hash("sha256", $row["username"]), time()+60*60*24*30);
            }
            header("Location: utama.php");
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Login Dulu</h1>
    <?php if ( isset($error) ) : ?>
        <p>Username/Password salah!</p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="username">Username </label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for='password'>Password </label>
        <input type='password' id='password' name='password'>
        <br>
        <input type='checkbox' id='remember' name='remember'>
        <label for='remember'>Remember me</label>
        <button type="submit" name="login">Masuk</button>
    </form>
</body>
</html>