<!-- Sidebar -->
<aside class="w-64 bg-gray-800 h-screen p-6 sticky top-0">
    <div class="text-center text-2xl font-bold mb-8">Member Dashboard</div>
    <ul class="space-y-4">
        <?php
        // Dapatkan nama file halaman saat ini
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <li>
            <a href="index.php"
                class="flex items-center p-3 rounded-lg transition-colors duration-300 ease-in-out 
                <?php echo $current_page == 'index.php' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                <svg class="w-6 h-6 mr-2 <?php echo $current_page == 'index.php' ? 'text-white' : 'text-gray-400'; ?>"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 15v3c0 .5523.44772 1 1 1h10.5M3 15v-4m0 4h11M3 11V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v5M3 11h18m0 0v1M8 11v8m4-8v8m4-8v2m1 4h2m0 0h2m-2 0v2m0-2v-2" />
                </svg>
                Mobil
            </a>
        </li>

        <li>
            <a href="tb_transaksi.php"
                class="flex items-center p-3 rounded-lg transition-colors duration-300 ease-in-out 
                <?php echo $current_page == 'tb_transaksi.php' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                <svg class="w-6 h-6 mr-2 <?php echo $current_page == 'tb_transaksi.php' ? 'text-white' : 'text-gray-400'; ?>"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 14H6v-2h12v2zm0-4H6v-2h12v2zm0-4H6V7h12v2z" />
                </svg>
                Transaksi
            </a>
        </li>
    </ul>
</aside>