<?php
require_once __DIR__."/pdo.php";
class db{
    static function query($sql, $data){
        $STMT = $PDO -> prepare($sql);
    }
}