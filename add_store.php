<!DOCTYPE html>
<html>
<head>
	<title>add store</title>
</head>
<body>
	<header>
		<a href="stores.php">Home</a>
		<?php require_once "header.php"; ?>
	</header>
	<?php

		$cities = $db->query("select * from cities");
	?>
	<main>
		<form action="insert_store.php" method="post" enctype="multipart/form-data">
			<label>
				Store name:
				<input type="text" name="store_name" required>
			</label>
			<label>
				Address
				<input type="text" name="address" required>
			</label>
			<label>
				City
				<select name="city" required>
					<?php
						if ($cities) {
							while($city = $cities->fetch_object()) {
							?>
								<option value="<?= $city->id ?>"><?= $city->city ?></option>
							<?php
							}
						}
						?>
					<option disabled selected>Select one</option>
				</select>
			</label>
			<label>
				Phone
				<input type="phone" name="phone" required>
			</label>
			<label>
				Manager
				<input type="text" name="manager" required>
			</label>
			<label>
				Photo
				<input type="file" name="photo" required>
			</label>
			<button>add</button>
		</form>
	</main>
</body>
</html>