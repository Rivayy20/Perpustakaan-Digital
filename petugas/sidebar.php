<!-- Sidebar -->
<aside class="w-64 bg-gray-800 h-screen p-6 sticky top-0">
    <div class="text-center text-2xl font-bold mb-8">Petugas Dashboard</div>
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
        <li>
            <a href="tb_bayar.php"
                class="flex items-center p-3 rounded-lg transition-colors duration-300 ease-in-out 
                <?php echo $current_page == 'tb_bayar.php' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                <svg class="w-6 h-6 mr-2 <?php echo $current_page == 'tb_bayar.php' ? 'text-white' : 'text-gray-400'; ?>"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M2 7c0-1.10457.89543-2 2-2h16c1.1046 0 2 .89543 2 2v4c0 .5523-.4477 1-1 1s-1-.4477-1-1v-1H4v7h10c.5523 0 1 .4477 1 1s-.4477 1-1 1H4c-1.10457 0-2-.8954-2-2V7Z" />
                    <path fill="currentColor"
                        d="M5 14c0-.5523.44772-1 1-1h2c.55228 0 1 .4477 1 1s-.44772 1-1 1H6c-.55228 0-1-.4477-1-1Zm5 0c0-.5523.4477-1 1-1h4c.5523 0 1 .4477 1 1s-.4477 1-1 1h-4c-.5523 0-1-.4477-1-1Zm9-1c.5523 0 1 .4477 1 1v1h1c.5523 0 1 .4477 1 1s-.4477 1-1 1h-1v1c0 .5523-.4477 1-1 1s-1-.4477-1-1v-1h-1c-.5523 0-1-.4477-1-1s.4477-1 1-1h1v-1c0-.5523.4477-1 1-1Z" />
                </svg>
                Pembayaran
            </a>
        </li>
        <li>
            <a href="tb_laporan.php"
                class="flex items-center p-3 rounded-lg transition-colors duration-300 ease-in-out 
                <?php echo $current_page == 'tb_laporan.php' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                <svg class="w-6 h-6 mr-2 <?php echo $current_page == 'tb_laporan.php' ? 'text-white' : 'text-gray-400'; ?>"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M6 16v-3h.375a.626.626 0 0 1 .625.626v1.749a.626.626 0 0 1-.626.625H6Zm6-2.5a.5.5 0 1 1 1 0v2a.5.5 0 0 1-1 0v-2Z" />
                    <path fill-rule="evenodd"
                        d="M11 7V2h7a2 2 0 0 1 2 2v5h1a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-1a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2H3a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h6a2 2 0 0 0 2-2Zm7.683 6.006 1.335-.024-.037-2-1.327.024a2.647 2.647 0 0 0-2.636 2.647v1.706a2.647 2.647 0 0 0 2.647 2.647H20v-2h-1.335a.647.647 0 0 1-.647-.647v-1.706a.647.647 0 0 1 .647-.647h.018ZM5 11a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 9 15.375v-1.75A2.626 2.626 0 0 0 6.375 11H5Zm7.5 0a2.5 2.5 0 0 0-2.5 2.5v2a2.5 2.5 0 0 0 5 0v-2a2.5 2.5 0 0 0-2.5-2.5Z"
                        clip-rule="evenodd" />
                    <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                </svg>
                Laporan Transaksi
            </a>
        </li>
    </ul>
</aside>