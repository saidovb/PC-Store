<?php
include __DIR__ . "/../db/config.php";
include __DIR__ . '/../partials/start.php';

$products = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- PC Selection Tabs -->
<section class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <h2 class="text-slate-100 text-3xl font-bold mb-2">PC Selection</h2>
            <p class="text-slate-400">Curated performance builds for creators and gamers.</p>
        </div>
        <div class="flex border-b border-border-dark">
            <a class="px-6 py-3 border-b-2 border-primary text-primary font-bold text-sm" href="#">All Systems</a>
            <a class="px-6 py-3 border-b-2 border-transparent text-slate-400 hover:text-slate-100 font-bold text-sm transition-colors" href="#">Laptops</a>
            <a class="px-6 py-3 border-b-2 border-transparent text-slate-400 hover:text-slate-100 font-bold text-sm transition-colors" href="#">Desktops</a>
            <a class="px-6 py-3 border-b-2 border-transparent text-slate-400 hover:text-slate-100 font-bold text-sm transition-colors" href="#">Workstations</a>
        </div>
    </div>
    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($products as $product):
            include __DIR__ . '/../components/card.php';
        endforeach; ?>
    </div>
</section>