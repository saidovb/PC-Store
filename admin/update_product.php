<?php
include __DIR__ . '/../partials/start.php';
require_once __DIR__ . '/../db/config.php';

$id = $_GET['id'];
$product = $db->prepare('SELECT * FROM products where id = ?');
$product->execute([$id]);
$product = $product->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $image = $_FILES['image'];
    $imagePath = null;

    if (!$name || !$price || !$desc) {
        $error = "Barcha maydonlarni to'ldiring!";
    } else {
        if ($image && $image['error'] === 0) {
            $imagePath = 'images/' . uniqid() . '_' . $image['name'];
            move_uploaded_file($image['tmp_name'], __DIR__ . '/../' . $imagePath);
        } else {
            $imagePath = $product["image"];
        }

        $stmt = $db->prepare('UPDATE products SET name = ?, price = ?, desc = ?, image = ? WHERE id = ?');
        $stmt->execute([$name, $price, $desc, $imagePath, $id]);
        header('Location: /admin/dashboard.php');
        exit();
    }
}
?>

<div class="min-h-screen">
    <div class='container mx-auto '>
        <div class='flex items-center justify-between mb-8 p-2'>
            <h1 class="text-4xl font-bold">Edit Product</h1>
        </div>

        <form method="post" class='flex flex-col gap-4 w-full' enctype="multipart/form-data">
            <input value="<?php echo $product["name"] ?>" class='text-black' type="text" name="name" placeholder="Name" required>
            <input value="<?php echo $product["price"] ?>" class='text-black' type="number" name="price" placeholder="Price" required>
            <textarea class='text-black' name="desc" placeholder="Description" required><?php echo $product["desc"] ?></textarea>
            <img src="/<?= $product["image"]; ?>" width="10%" height="20%" alt="">
            <span>Upload new image: <input class='text-white' type="file" name="image" placeholder='Mahsulot rasmi'></span>


            <button type="submit" class='px-4 py-2 bg-blue-500 text-white rounded'>Edit</button>
        </form>
    </div>
</div>

<?php
include __DIR__ . '/../partials/end.php';
