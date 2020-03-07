<?php

$error = false;
if (!$_POST["store_name"]) {
	$error = true;
?><?= "error: must provide store name<br>"; ?><?php
}

if (!$_POST["address"]) {
	$error = true;
?><?= "error: must provide address<br>" ?><?
}

if (!$_POST["city"]) {
	$error = true;
?><?= "error: must select city<br>" ?><?
}

if (!$_POST["phone"]) {
	$error = true;
?><?= "error: must provide phone<br>" ?><?
}

if (!$_POST["manager"]) {
	$error = true;
?><?= "error: must provide manager<br>" ?><?
}

$file = getcwd() . "/images/" . $_FILES["photo"]["name"];
if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $file)) {
	$error = true;
	echo "error: saving file or file not provided<br>";
}

if ($error) {
	exit();
}

$db = new mysqli("localhost:3306", "php", "php", "phpplar");

if ($db->connect_errno) {
	printf("db connect error");
	exit();
}

$query = $db->prepare("insert into stores (store_name, address, city_id, phone, manager, photo) values (?, ?, ?, ?, ?, ?)");
$query->bind_param("ssisss", $_POST["store_name"], $_POST["address"], $_POST["city"], $_POST["phone"], $_POST["manager"], $_FILES["photo"]["name"]);

if ($query->execute()) {
	header("Location: /stores.php");
}
