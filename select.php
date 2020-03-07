<?php

$name = 'Rich F';
$db = new PDO('mysql:host=mysql7.loosefoot.com;dbname=w20', 'comp1006', 'helpme20');

$sql = "SELECT email FROM persons WHERE name = :name";
$cmd = $db->prepare($sql);
$cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
$cmd->execute();

$email = $cmd->fetchColumn();

echo $email;

$db = null;
?>