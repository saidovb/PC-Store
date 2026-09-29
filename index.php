<?php
include "./db/config.php";
$products = $db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);

include "./partials/start.php";
include "./components/header.php"
?>

<main class="flex-1 max-w-[1440px] mx-auto w-full px-6 lg:px-20 py-8">
<?php
include "components/hero.php";
include "components/pc.php";
include "components/news.php";
?>
</main>
<?php
include "components/footer.php";
include "partials/end.php";
?>
