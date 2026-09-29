<?php
include __DIR__ . "/../db/config.php";
include __DIR__ . "/../partials/start.php";

$products = $db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="main-h-screen">
    <div class="container mx-auto px-4 mt-3">
        <div class="flex items-center justify-between mb-8 p-2">
            <h1 class="text-4xl font-bold">Admin Dashboard</h1>
            <a href="/admin/add_product.php" class="ml-4 px-4 py-2 bg-green-500 text-white rounded">Add Products</a>
        </div>

        <div class="border-y border-slate-600 pt-2 pb-3">
            <span class="text-xl font-semibold text-slate-100 tracking-wide">All Products</span>
            <span class="text-xs text-slate-400"><?= count($products) ?> items</span>

            <!-- Product Grid -->
            <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-6">

                <?php foreach ($products as $product): ?>
                    <div class="bg-surface-dark rounded-xl border border-border-dark overflow-hidden group hover:border-primary/50 transition-all flex flex-col">

                        <!-- Image -->
                        <div class="relative sm:h-48  lg:h-64 w-full overflow-hidden bg-background-dark">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="<?= !empty($product["image"]) ? "/" . $product["image"] : "/images/standart image/no_img.png" ?>" />

                            <!-- Delete Button -->
                            <div class="absolute top-2 right-2">
                                <form action='/admin/delete_product.php' method='post'>
                                    <input type="hidden" name="id" value="<?= $product["id"] ?>">
                                    <button class="flex items-center justify-center w-8 h-8 bg-white/10 backdrop-blur-md border border-white/20 rounded-full shadow-md hover:bg-red-500/80 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                <a href="/admin/update_product.php?id=<?= $product["id"]; ?>">
                                    <button class="flex items-center justify-center mt-1 w-8 h-8 bg-white/10 backdrop-blur-md border border-white/20 rounded-full shadow-md hover:bg-blue-400/80 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-4 flex flex-col gap-2">
                            <h3 class="text-slate-100 font-semibold text-sm leading-tight truncate">
                                <?= $product["name"] ?>
                            </h3>

                            <p class="text-slate-400 text-[12px] line-clamp-3">
                                <?= $product["desc"] ?>
                            </p>

                            <span class="text-slate-100 font-bold text-sm mt-1">
                                <?= "$ " . $product["price"] ?>
                            </span>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . "/../partials/end.php";
?>