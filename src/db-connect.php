<?php
    const SERVER = 'mysql217.phy.lolipop.lan';
    const DBNAME = 'LAA1517479-final';
    const USER = 'LAA1517479';
    const PASS = 'Pass0414';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    $pdo = new PDO($connect, USER, PASS);
?>