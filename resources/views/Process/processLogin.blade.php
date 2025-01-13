<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if(isset($_SESSION["user"])){
    header("Location: /home");
    exit;
}

if(isset($_POST["mencoba_login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($email) || empty($password)){
        $_SESSION["error"] = "Email dan password harus diisi !";

        header("Location: /login");
        exit;
    }

    $_SESSION["user"] = [
        "email" => $email,
        "password" => $password
    ];

    if($email != 'admin@gmail.com' && $password != 'admin'){
        header("Location: /home");
        exit;
    }else{
        header("Location: /Admin/admin_home");
        exit;
    }
}
?>