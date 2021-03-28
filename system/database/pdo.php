<?php
$DB_ENV = json_decode(file_get_contents(__DIR__."/../../env/database.json"), true);
$DB_HOST = $DB_ENV["DB_HOST"];
$DB_NAME = $DB_ENV["DB_NAME"];
try{
    $PDO = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8", $DB_ENV["DB_USER"], $DB_ENV["DB_PASS"], [PDO::ATTR_EMULATE_PREPARES => false]);
}catch(PDOException $e) {
    $date = date("YmdHis");
    header("Location: /err?status=500&code={$date}");
    exit(file_put_contents(__DIR__."/../../logs/db/{$date}.txt", $e->getMessage()));
}