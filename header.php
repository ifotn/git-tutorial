<?php
$db = new mysqli("localhost:3306", "root", "", "comp1006");

if ($db->connect_errno) {
	printf("db connect error");
	exit();
}

$cities = $db->query("select * from cities");

if ($cities) {
	?>
	<ul>
	<?php
	while($city = $cities->fetch_object()) {
	?>
		<li>
			<a href="stores.php?id=<?= $city->id ?>">
				<?= $city->city ?>
			</a>
		</li>
	<?php
	}
	?>
	</ul>
	<?php
	$cities->close();
}
