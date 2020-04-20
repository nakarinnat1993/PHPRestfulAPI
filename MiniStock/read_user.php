<?php
require_once __DIR__."/vendor/autoload.php";

use BasicAPI\Connectdb;


$dbconnect = new Connectdb();
$connection = $dbconnect->getConnect();

$sql = "SELECT * FROM users order by id desc";
$stmt = $connection->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($result);
echo json_encode($result);


