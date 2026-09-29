<?php
session_start();
include __DIR__ . "/../db/config.php";
include __DIR__ . "/../partials/start.php";
include __DIR__ . "/../components/header.php";

$category = $_GET["category"] ?? "all";
$search = $_GET["search"] ?? "";

if (!$search) {
    if ($category == "all") {
        $products = $db->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $db->prepare("SELECT * FROM products WHERE category = ? ORDER BY id DESC");
        $stmt->execute([$category]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $stmt = $db->prepare("SELECT * FROM products WHERE name LIKE ? OR `desc` LIKE ? ORDER BY id DESC");
    $stmt->execute(["%$search%", "%$search%"]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<main class="flex-1 max-w-[1440px] mx-auto w-full px-6 lg:px-20 py-8">
    <!-- PC Selection Tabs -->
    <section class="mb-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-slate-100 text-3xl font-bold mb-2">Cart</h2>
                <p class="text-slate-400">Curated performance builds for creators and gamers.</p>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($products as $product): ?>
                <!-- Product 1 -->
                <div class="bg-surface-dark rounded-xl border border-border-dark overflow-hidden group hover:border-primary/50 transition-all flex flex-col">
                    <div class="relative aspect-square overflow-hidden bg-background-dark">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Powerful desktop gaming tower with RGB lighting" src="/<?= $product["image"] ?>" />
                        <div class="absolute top-3 right-3 bg-background-dark/80 backdrop-blur-sm text-primary px-2 py-1 rounded-md text-xs font-bold"><?= $product["category"] ?></div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-slate-100 font-bold text-lg group-hover:text-primary transition-colors"><?= $product["name"] ?></h3>
                            <div class="flex items-center text-yellow-500">
                                <span class="text-xs font-bold ml-1 text-slate-300"><?= $product["stock"] ?> left</span>
                            </div>
                        </div>
                        <p class="text-slate-400 text-xs mb-4"><?= $product["desc"] ?></p>
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-slate-100 font-bold text-xl"><?= "$ " . $product["price"] ?></span>
                            <button class="size-10 bg-primary/10 text-primary rounded-lg hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php
include __DIR__ . "/../components/footer.php";
include __DIR__ . "/../partials/end.php";
?>