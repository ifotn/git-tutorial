<?php
$db = new mysqli("localhost:3306", "php", "php", "phpplar");

if ($db->connect_errno) {
	printf("db connect error");
	exit();
}

$query = $db->prepare("delete from stores where id = ?");
$query->bind_param("i", $_GET["store_id"]);

if(!$query->execute()) {
	echo "error: db error";
	exit();
}

header("Location: /stores.php?id=" . $_GET["city_id"]);