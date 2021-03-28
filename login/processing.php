<?php
session_start();
require_once "../system/database/pdo.php";
if(isset($_SESSION["ACSSES_TOKEN"])){
    $user_id = $_SESSION["ACSSES_TOKEN"]["user_id"];
    $stmt = $PDO -> query("SELECT EXISTS(SELECT * FROM `login` WHERE `uid` = {$user_id}) AS EXIUSER");
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo $row["EXIUSER"];
    if($row["EXIUSER"] === 1){
        $stmt = $PDO -> query("SELECT `auth` FROM `login` WHERE uid = {$user_id} AS AUTH");
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($row["AUTH"] === "allow"){
            header("Location: /home/");
        }else{
            header("Location: ./lock/");
        }
    }else{
        $csrf = bin2hex(openssl_random_pseudo_bytes(16));
        unset($_SESSION["CSRF_TOKEN"]);
        $_SESSION["CSRF_TOKEN"] = $csrf;
        header("Location: ./privacy/?csrf={$csrf}");
    }
}