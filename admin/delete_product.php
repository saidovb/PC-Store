<?php

include __DIR__ . "/../db/config.php";

if ($_POST) {
	$id = $_POST['id'];

	if (!$id) {
		echo "ID has not given";
		return;
	}

	$stmt = $db->prepare('DELETE FROM products WHERE id = ?');
	$stmt->execute([$id]);
	header('Location: /admin/dashboard.php');
} else {
	echo "Error!";
}