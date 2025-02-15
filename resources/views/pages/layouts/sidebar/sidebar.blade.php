{{-- sidebar --}}

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-main md:translate-x-0" aria-label="Sidebar">
<div class="flex items-center justify-center py-14">
    <img src="{{ asset('images/icon/logo.png') }}" alt="Rafa" class="w-36">
</div>
<div class="h-full px-3 pb-4 bg-main dark:bg-gray-800">
    <div class="h-[75vh] md:h-[80vh] pb-4 bg-main overflow-y-auto scrollbar-thinner pr-2">
        <ul class="font-medium">
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('dashboard-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('dashboard') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">DASHBOARD</span>
                </a>
            </li>
            @if(session('tier') == 'super_admin' || session('tier') == 'admin_member')
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('pangkat-page') }}" class="flex items-center py-2 {{ Request::is('pangkat*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">ADD PANGKAT</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('reward-page') }}" class="flex items-center py-2 {{ Request::is('reward*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">ADD REWARD</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('promo-page') }}"  class="flex items-center py-2 {{ Request::is('promo*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">ADD PROMO</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('member-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('member*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">MEMBER</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('event-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('event*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">EVENT</span>
                </a>
            </li>
            @endif
            @if(session('tier') == 'super_admin' || session('tier') == 'admin_gudang')
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('product-index') }}" class="flex items-center py-2 rounded-lg {{ Request::is('product*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">ADD PRODUK</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('profile-gudang') }}" class="flex items-center py-2 rounded-lg {{ Request::is('profileGudang*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">ADD GUDANG</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('gudang-utama') }}" class="flex items-center py-2 rounded-lg {{ Request::is('gudangUtama*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">GUDANG UTAMA</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('gudang-cabang-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('gudangCabang*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">GUDANG CABANG</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('stok-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('stok*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">GUDANG -> GUDANG</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('transaksi') }}" class="flex items-center py-2 rounded-lg {{ Request::is('transaksi*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">GUDANG -> MEMBER</span>
                </a>
            </li>
            @endif
            @if(session('tier') == 'super_admin' || session('tier') == 'admin_member')
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('notifikasi-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('notifikasi*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ms-3">PUSAT NOTIFIKASI</span>
                </a>
            </li>
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('pengaturan-page') }}" class="flex items-center py-2 rounded-lg {{ Request::is('pengaturan*') ? 'bg-gray-100 text-gray-700' : 'text-white hover:text-gray-700 dark:text-white' }} dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">PENGATURAN</span>
                </a>
            </li>
            @endif
            <hr class="border-t border-gray-100 border-opacity-30 dark:border-gray-600 my-1">
            <li class="px-3">
                <a href="{{ route('logout-action') }}" class="flex items-center py-2 text-white rounded-lg hover:text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="ms-3">LOGOUT</span>
                </a>
            </li>
        </ul>
    </div>
</div>
</aside>