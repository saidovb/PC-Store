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
                <h2 class="text-slate-100 text-3xl font-bold mb-2">All Products</h2>
                <p class="text-slate-400">Curated performance builds for creators and gamers.</p>
            </div>
            <div class="flex border-b border-border-dark">
                <a class="px-6 py-3 border-b-2 <?= $category == 'all' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-100' ?> font-bold text-sm transition-colors"
                    href="/pages/products.php?category=all">All Products</a>

                <a class="px-6 py-3 border-b-2 <?= $category == 'laptop' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-100' ?> font-bold text-sm transition-colors"
                    href="/pages/products.php?category=laptop">Laptops</a>

                <a class="px-6 py-3 border-b-2 <?= $category == 'desktop' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-100' ?> font-bold text-sm transition-colors"
                    href="/pages/products.php?category=desktop">Desktops</a>

                <a class="px-6 py-3 border-b-2 <?= $category == 'component' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-100' ?> font-bold text-sm transition-colors"
                    href="/pages/products.php?category=component">Components</a>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product):
                    include __DIR__ . '/../components/card.php';
                endforeach; ?>
            </div>
    </section>
</main>

<?php
include __DIR__ . "/../components/footer.php";
include __DIR__ . "/../partials/end.php";
?>