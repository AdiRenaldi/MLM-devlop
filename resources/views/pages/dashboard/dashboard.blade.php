{{-- dashboard --}}
@extends('pages.layouts.layoutMaster')

@section('title','Dashboard')

@section('content')
<section id="content">
<div class="p-4 md:ml-64">
    <div class="p-4 mt-12 md:mt-14">
        <div class="flex flex-col items-center lg:w-8/12 justify-center mb-5 lg:mb-8 rounded bg-white dark:bg-gray-800">
            <div class="bg-secondary w-full rounded-lg p-3 text-white">PENYERAHAN REWARD</div>
            <div class="p-3 bg-popup mt-1 rounded-lg w-full">
            <p class="text-gray-600">UMRAH BERSAMA OWNER</p>
            <p class="text-gray-600">DAPAT MOBIL BARU</p>
            <p class="text-gray-600">JALAN-JALAN KE PARIS</p>
            <p class="text-gray-600">LIBURAN KE BALI</p>
            <p class="text-gray-600">UANG TUNAI LANGSUNG DARI RAFA</p>
            </div>
        </div>
        <div class="lg:grid lg:grid-cols-2 gap-4 lg:mb-5">
            <div class="flex flex-col items-center w-full justify-center mb-5 lg:mb-4 rounded bg-white dark:bg-gray-800">
            <div class="bg-secondary w-full rounded-lg p-3 text-white">KOTA PENJUALAN TERATAS</div>
            <div class="p-3 bg-popup mt-1 rounded-lg w-full">
                <p class="text-gray-600">UMRAH BERSAMA OWNER</p>
                <p class="text-gray-600">DAPAT MOBIL BARU</p>
                <p class="text-gray-600">JALAN-JALAN KE PARIS</p>
                <p class="text-gray-600">LIBURAN KE BALI</p>
                <p class="text-gray-600">UANG TUNAI LANGSUNG DARI RAFA</p>
            </div>
            </div>
            <div class="flex flex-col items-center w-full justify-center mb-5 lg:mb-4 rounded bg-white dark:bg-gray-800">
            <div class="bg-secondary w-full rounded-lg p-3 text-white">KOTA PENJUALAN TERENDAH</div>
            <div class="p-3 bg-popup mt-1 rounded-lg w-full">
                <p class="text-gray-600">UMRAH BERSAMA OWNER</p>
                <p class="text-gray-600">DAPAT MOBIL BARU</p>
                <p class="text-gray-600">JALAN-JALAN KE PARIS</p>
                <p class="text-gray-600">LIBURAN KE BALI</p>
                <p class="text-gray-600">UANG TUNAI LANGSUNG DARI RAFA</p>
            </div>
            </div>
        </div>
        <div class="lg:grid lg:grid-cols-2 gap-4">
            <div class="flex flex-col items-center w-full justify-center mb-5 lg:mb-4 rounded bg-white dark:bg-gray-800">
            <div class="bg-secondary w-full rounded-lg p-3 text-white">MEMBER DENGAN POIN TERATAS</div>
            <div class="p-3 bg-popup mt-1 rounded-lg w-full">
                <p class="text-gray-600">UMRAH BERSAMA OWNER</p>
                <p class="text-gray-600">DAPAT MOBIL BARU</p>
                <p class="text-gray-600">JALAN-JALAN KE PARIS</p>
                <p class="text-gray-600">LIBURAN KE BALI</p>
                <p class="text-gray-600">UANG TUNAI LANGSUNG DARI RAFA</p>
            </div>
            </div>
            <div class="flex flex-col items-center w-full justify-center mb-5 lg:mb-4 rounded bg-white dark:bg-gray-800">
            <div class="bg-secondary w-full rounded-lg p-3 text-white">MEMBER DENGAN POIN TERENDAH</div>
            <div class="p-3 bg-popup mt-1 rounded-lg w-full">
                <p class="text-gray-600">UMRAH BERSAMA OWNER</p>
                <p class="text-gray-600">DAPAT MOBIL BARU</p>
                <p class="text-gray-600">JALAN-JALAN KE PARIS</p>
                <p class="text-gray-600">LIBURAN KE BALI</p>
                <p class="text-gray-600">UANG TUNAI LANGSUNG DARI RAFA</p>
            </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection