<nav class="bg-white text-neutral-900 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
                <div class="hidden md:block">
                    <h1 class="font-bold text-xl tracking-tight">Pencatatan Satpam</h1>
                </div>
                <div class="md:hidden">
                    <h1 class="font-bold text-lg">Satpam</h1>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <!-- <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white/10 transition-colors duration-200">
                    Dashboard
                </a>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white/10 transition-colors duration-200">
                    Laporan
                </a> -->
                <a href="pages/login-view.php" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 transition-colors duration-200">
                    Login
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-btn p-2 rounded-md hover:bg-white/10 transition-colors duration-200" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden mobile-menu hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 border-t border-blue-500/30">
                <!-- <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white/10 transition-colors duration-200">
                    Dashboard
                </a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white/10 transition-colors duration-200">
                    Laporan
                </a> -->
                <a href="pages/login-view.php" class="block px-3 py-2 rounded-md text-base font-medium bg-red-500 hover:bg-red-600 transition-colors duration-200 mt-2">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
    const menu = document.querySelector('.mobile-menu');
    menu.classList.toggle('hidden');
});
</script>