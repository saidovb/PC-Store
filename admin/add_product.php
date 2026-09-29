<?php

include __DIR__ . '/../partials/start.php';
require_once __DIR__ . '/../db/config.php';

if ($_POST) {
	$name = $_POST['name'];
	$price = $_POST['price'];
	$desc = $_POST['desc'];
	$category = $_POST['category'];
	$stock = $_POST['stock'];
	$image = $_FILES['image'];
	$imagePath = null;

	if (!$name || !$price || !$desc || !$category || !$stock) {
		$error = "Barcha maydonlarni to'ldiring!";
	} else {
		if ($image && $image['error'] === 0) {
			$imagePath = 'images/' . uniqid() . '_' . $image['name'];
			move_uploaded_file($image['tmp_name'], __DIR__ . '/../' . $imagePath);
		} else {
			$imagePath = null;
		}

		$stmt = $db->prepare('INSERT INTO products (name, price, desc, stock, category, image) VALUES (?, ?, ?, ?, ?, ?)');
		$stmt->execute([$name, $price, $desc, $stock, $category, $imagePath]);
		header('Location: /admin/dashboard.php');
		exit();
	}
}



?>

<div class="min-h-screen">
	<div class='container mx-auto '>
		<div class='flex items-center justify-between mb-8 p-2'>
			<h1 class="text-4xl font-bold">Add Product</h1>
		</div>

		<form method="post" class='flex flex-col gap-4 w-full' enctype="multipart/form-data">
			<input class='text-black' type="text" name="name" placeholder="Name" required>
			<input class='text-black' type="number" name="price" placeholder="Price" required>
			<textarea class='text-black' name="desc" placeholder="Description" required></textarea>
			<select class='text-black' name="category" required>
				<option value="">Kategoriya tanlang</option>
				<option value="laptop">Laptop</option>
				<option value="desktop">Desktop</option>
				<option value="component">Component</option>
			</select>
			<input class='text-black' type="number" name="stock" placeholder="Mahsulot soni" required>

			<input class='text-white' type="file" name="image" placeholder='Mahsulot rasmi'>

			<button type="submit" class='px-4 py-2 bg-blue-500 text-white rounded'>Add</button>
		</form>
	</div>
</div>

<?php
include __DIR__ . '/../partials/end.php';
