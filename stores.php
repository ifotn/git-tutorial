<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>stores</title>
</head>
<body>
	<header>
		<a href="stores.php">Home</a>
		<?php require_once "header.php"; ?>
	</header>
	<main>
		<a href="/add_store.php">Add store</a>
		<a href="/search.php">Search stores</a>
		<?php 

		function get_sort_dir($dir) {
			if ($dir === "asc") {
				return "desc";
			}
			return "asc";
		}

		function get_sort_col($by) {
			switch ($by) {
				case "store":
					return "store_name";
				case "address":
					return "address";
				case "manager":
					return "manager";
				case "phone":
					return "phone";
				default:
					return "id";
			}
		}

		if ($_GET["id"]) {
			if ($_GET["sort"] && $_GET["dir"]) {
				echo "yes";
				if ($_GET["dir"] === "asc") {
					// this is really dumb, but I couldn't get "order by ? " to work :(
					$query = $db->prepare("select * from stores where city_id = ? order by " . get_sort_col($_GET["sort"]) . " asc");
				} else {
					$query = $db->prepare("select * from stores where city_id = ? order by " . get_sort_col($_GET["sort"]) . " desc");
				}
				$query->bind_param("i", $_GET["id"]);
			} else {
				$query = $db->prepare("select * from stores where city_id = ? ");
				$query->bind_param("i", $_GET["id"]);
			}
			$query->execute();
			$stores = $query->get_result();
		}
		?>
		<table>
			<thead>
				<tr>
					<th><a href="/stores.php?id=<?= $_GET["id"] ?>&sort=store&dir=<?= get_sort_dir($_GET["dir"]) ?>">Store name</a></th>
					<th><a href="/stores.php?id=<?= $_GET["id"] ?>&sort=address&dir=<?= get_sort_dir($_GET["dir"]) ?>">Address</a></th>
					<th><a href="/stores.php?id=<?= $_GET["id"] ?>&sort=manager&dir=<?= get_sort_dir($_GET["dir"]) ?>">Manager</a></th>
					<th><a href="/stores.php?id=<?= $_GET["id"] ?>&sort=phone&dir=<?= get_sort_dir($_GET["dir"]) ?>">Phone</a></th>
					<th>Image</th>
					<th>Delete</th>
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
						<td><?= $store->manager ?></td>
						<td><?= $store->phone ?></td>
						<td><img src="images/<?= $store->photo ?>" height="80"></td>
						<td>
							<a href="delete_store.php?store_id=<?= $store->id ?>&city_id=<?= $store->city_id ?>">Delete</a>
						</td>
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