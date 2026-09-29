<?php

include_once __DIR__ . "/../db/config.php";
include_once __DIR__ . "/../utils/functions.php";

$user = user();

if ($_POST) {
    $product_id = $_POST["product_id"];
    $user_id = $_POST["user_id"];
}

?>



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
            <form method="post">
                <input type="hidden" value="">
                <button class="size-10 bg-primary/10 text-primary rounded-lg hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                </button>
            </form>
        </div>
    </div>
</div>