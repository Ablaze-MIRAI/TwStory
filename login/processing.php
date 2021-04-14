<?php
session_start();
require_once "../system/database/pdo.php";
if(isset($_SESSION["ACSSES_TOKEN"])){
    $user_id = $_SESSION["ACSSES_TOKEN"]["user_id"];
    $stmt = $PDO -> query("SELECT EXISTS(SELECT * FROM `login` WHERE `uid` = {$user_id}) AS EXIUSER");
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($row["EXIUSER"] === 1){
        $stmt = $PDO->prepare("SELECT `auth` FROM `login` WHERE uid = :id");
        $stmt->bindValue(":id", "1175900055485599744", PDO::PARAM_INT);
        $stmt->execute();
        var_dump($stmt);
        if(true){
            //header("Location: /home/");
        }else{
            //header("Location: ./lock/");
        }
    }else{
        $csrf = bin2hex(openssl_random_pseudo_bytes(16));
        unset($_SESSION["CSRF_TOKEN"]);
        $_SESSION["CSRF_TOKEN"] = $csrf;
        header("Location: ./privacy/?csrf={$csrf}");
    }
}