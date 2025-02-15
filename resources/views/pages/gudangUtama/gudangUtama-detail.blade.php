@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="#">GUDANG UTAMA</a> -> {{ $pageConfigs['title'] }}</h3>
                </div>
                <div class="px-10 mb-8">
                    <div class="flex">
                        <div class="w-2/4">
                            <div class="mb-6">
                                <span class="text-main bg-popup border-b border-main text-lg block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">ID : {{ $stokGudang->kd_stokGudangUtama }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Kategori</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $stokGudang->product->category }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Nama Produk</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $stokGudang->product->namaProduk }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Harga</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $stokGudang->product->harga }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Stok Masuk</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ \Carbon\Carbon::parse($stokGudang->stokMasuk)->format('d-m-Y') }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Masa Expire</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ \Carbon\Carbon::parse($stokGudang->masaExpire)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($stokGudang->masaExpire)->isPast() ? 'Kadaluarsa' : '' }}</span>
                            </div>
                            {{-- <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Status</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ isset($stokGudang->status) ? $stokGudang->status : 'null' }}</span>
                            </div> --}}
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Lokasi Stok</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ isset($stokGudang->stokLokasi) ? $stokGudang->stokLokasi : 'null' }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Deskripsi Stok</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ isset($stokGudang->deskripsi) ? $stokGudang->deskripsi : 'null' }}</span>
                            </div>
                        </div>
                        <div class="w-2/4 ps-4">
                            
                            <img class="h-64 md:h-80 max-w-full shadow-lg shadow-main rounded-lg" src="{{ Storage::url('images/products/' . $stokGudang->product->image) }}" alt="{{ $stokGudang->product->image }}">

                        </div>
                    </div>
                    <div class="flex justify-center mt-10">
                        <a href="{{ route('gudang-utama') }}" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection