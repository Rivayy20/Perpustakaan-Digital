<!-- Sidebar -->
<aside class="w-64 bg-gray-800 h-screen p-6 sticky top-0">
    <div class="text-center text-2xl font-bold mb-8">Admin Dashboard</div>
    <ul class="space-y-4">
        <?php
        // Dapatkan nama file halaman saat ini
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <li>
            <a href="tb_user.php"
                class="flex items-center p-3 rounded-lg transition-colors duration-300 ease-in-out 
                <?php echo $current_page == 'tb_user.php' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                <svg class="w-6 h-6 mr-2 <?php echo $current_page == 'tb_user.php' ? 'text-white' : 'text-gray-400'; ?>"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                Pengguna
            </a>
        </li>

        <li>
            <a href="tb_member.php"
                class="flex items-center p-3 rounded-lg transition-colors duration-300 ease-in-out 
                <?php echo $current_page == 'tb_member.php' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                <svg class="w-6 h-6 mr-2 <?php echo $current_page == 'tb_member.php' ? 'text-white' : 'text-gray-400'; ?>"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                        clip-rule="evenodd" />
                </svg>
                Member
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