<div class="min-h-screen flex flex-col bg-gray-800 text-white w-64 fixed md:relative z-30">
    <div class="flex items-center justify-center h-16 bg-gray-900">
        <span class="text-xl font-bold">Pencatatan Kehilangan</span>
    </div>
    <nav class="flex-1 px-2 py-4 space-y-2">
        <a href="../pages/dashboard-view.php" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
            Dashboard
        </a>
        <a href="../pages/tambah-catatan-view.php" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
            Buat Catatan
        </a>
        <!-- <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
            Laporan
        </a> -->
        <a href="../pages/profile-view.php" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 transition">
            Profil
        </a>
    </nav>
    <div class="p-4 border-t border-gray-700">
        <form action="../handlers/logout_handler.php" method="POST">
            <button onclick="return confirm('Yakin ingin keluar?')"
                class="w-full flex items-center justify-center px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</div>
<!-- Mobile menu button -->
<div class="md:hidden fixed top-4 left-4 z-40">
    <button id="sidebarToggle" class="text-white bg-gray-800 p-2 rounded focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>
<script>
    // Sidebar toggle for mobile
    const sidebar = document.querySelector('.w-64');
    const toggleBtn = document.getElementById('sidebarToggle');
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
    // Hide sidebar by default on mobile
    if(window.innerWidth < 768) {
        sidebar.classList.add('hidden');
    }
    window.addEventListener('resize', () => {
        if(window.innerWidth < 768) {
            sidebar.classList.add('hidden');
        } else {
            sidebar.classList.remove('hidden');
        }
    });
</script>