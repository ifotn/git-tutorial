<!DOCTYPE html>
<html>
<head>
	<title>search</title>
</head>
<body>
	<header>
		<a href="stores.php">Home</a>
		<?php require_once "header.php"; ?>
	</header>
	<?php
		if ($_GET["search"]) {
			// this is just hilarously bad, but $query->bind_params was being stupid and complaining (?!?!?)
			$query = $db->prepare("select * from stores join cities on stores.city_id = cities.id where address like '%" . $_GET["search"] . "%'");
			$query->execute();
			$stores = $query->get_result();
		}
	?>
	<main>
		<form action="/search.php">
			<input type="text" name="search">
			<button>search</button>
		</form>
		<table>
			<thead>
				<tr>
					<th>Store name</th>
					<th>Address</th>
					<th>City</th>
					<th>Phone</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($stores) {
					while($store = $stores->fetch_object()) {
					?>
					<tr>
						<td><?= $store->store_name ?></td>
						<td><?= $store->address ?></td>
						<td><?= $store->city ?></td>
						<td><?= $store->phone ?></td>
					</tr>
					<?php
					}
				}
				?>
			</tbody>
		</table>
	</main>
</body>
</html>