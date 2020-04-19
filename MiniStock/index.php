<?php
require_once __DIR__."/vendor/autoload.php";

use BasicAPI\Connectdb;

$dbconnect = new Connectdb();
$connection = $dbconnect->getConnect();

$username = "nakarin";
$password = "password";
$fullname = "Nakarin Jaiseengam";
$email = "nakarin@gmail.com";
$tel = "0802239171";
$status = "1";

$sql = "INSERT INTO users 
        (username,password,fullname,email,tel,status) 
        VALUES 
        (:username,:password,:fullname,:email,:tel,:status)";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':username',$username);
$stmt->bindParam(':password',$password);
$stmt->bindParam(':fullname',$fullname);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':tel',$tel);
$stmt->bindParam(':status',$status);

if($stmt->execute()){
    echo "Success";
}else{
    echo "Faill";
}