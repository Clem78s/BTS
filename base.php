<?php
$hostnom = 'host=serverbtssiojv.ddns.net';
$usernom = 'martin';
$password = 'martin';
$bdd = 'martin_tp3_slam_biblio';

try {
    $monPdo = new PDO("mysql:$hostnom;dbname=$bdd;charset=utf8", $usernom, $password);
    $monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    $monPdo = null;
}
?>
