<?php
include  __DIR__ . "/../utils/functions.php";
include  __DIR__ . "/../db/config.php";

?>

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-50 w-full border-b border-solid border-border-dark bg-background-dark/80 backdrop-blur-md px-6 lg:px-20 py-4">
    <div class="max-w-[1440px] mx-auto flex items-center justify-between gap-8">
        <div class="flex items-center gap-12">
            <!-- Logo -->
            <div class="flex items-center gap-3 text-primary">
                <div class="size-8 flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl">terminal</span>
                </div>
                <h2 class="text-slate-100 text-2xl font-bold leading-tight tracking-tight">TechStore</h2>
            </div>
            <!-- Nav Links -->
            <nav class="hidden lg:flex items-center gap-8">
                <a class="text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="/pages/products.php?category=laptop">Laptops</a>
                <a class="text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="/pages/products.php?category=desktop">Desktops</a>
                <a class="text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="/pages/products.php?category=component">Components</a>
            </nav>
        </div>
        <!-- Search and Actions -->
        <div class="flex flex-1 justify-end items-center gap-6">


            <form action="/pages/products.php" method="get">

                <label class="hidden md:flex flex-col min-w-48 max-w-sm w-full">
                    <div class="flex items-center rounded-lg bg-surface-dark border border-border-dark focus-within:border-primary px-4 py-2 transition-all">
                        <span class="material-symbols-outlined text-slate-400 text-xl">search</span>
                        <input class="w-full border-none bg-transparent text-slate-100 focus:ring-0 placeholder:text-slate-500 text-sm ml-2" name="search" id="search_form" placeholder="Search premium hardware..." value="" />
                        <input type="submit" value="Search" class="bg-primary py-1 px-2 cursor-pointer">
                    </div>
                    <script>
                        // Get the form element
                        const form = document.getElementById('searchForm');

                        // Search form submit on Enter
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();

                            const formData = new FormData(form);
                            const query = formData.get('search').trim();

                            if (query) {
                                window.location.href = `/pages/products.php?search=${encodeURIComponent(query)}`;
                            } else {
                                window.location.href = '/pages/products.php';
                            }
                        });
                    </script>
                </label>

            </form>

            <?php if (user("is_admin")): ?>
                <a href='/admin/dashboard.php'
                    class="text-sm font-medium text-primary border border-primary rounded-lg px-4 py-2 hover:bg-primary/20 transition-colors">
                    Dashboard
                </a>
            <?php endif; ?>

            <div class="flex gap-3">
                <button class="flex items-center justify-center rounded-lg h-10 w-10 bg-surface-dark border border-border-dark text-slate-100 hover:bg-primary/20 transition-colors">
                    <a href="pages/login.php" class="material-symbols-outlined">person</a>
                </button>
                <a href="/pages/cart.php" class="flex items-center justify-center rounded-lg h-10 w-10 bg-surface-dark border border-border-dark text-slate-100 hover:bg-primary/20 transition-colors relative">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="absolute -top-1 -right-1 bg-primary text-[10px] font-bold px-1.5 rounded-full border-2 border-background-dark">3</span>
                </a>
            </div>
            <div class="h-10 w-10 rounded-full bg-primary/20 border border-primary/40 flex items-center justify-center overflow-hidden">
                <img alt="User Profile" class="w-full h-full object-cover" data-alt="Modern user profile avatar circular" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCe7tnKfQuh_Astb86U1NeWdLZz2tiXS7HuyKftVM1rSfKEjdxiY7RjXV0EnTDyxhaei3XKRaSX5HDKj8XGQJMcPvHic7FvURo9omcFDbrB588YsUHcaERZstnNcgB0EqnxN1HWo8mZw55Knd7P5WZY2RZndiThtiC4OylMpUKqX8gwDjjw-hFPV7wIiSqwu3AvNKq9sj5x0-3NbJL3vujeU8leArxJ165y9uKaqcLxGphjzbBLsbTGNd77IUnzsAi2fP3-41DtCrM" />
            </div>
        </div>
    </div>
</header>