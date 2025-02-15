{{-- tambah member --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('member-page') }}">MEMBER</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="namaProduk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                            <input type="text" name="namaProduk" id="namaProduk" value="{{ old('namaProduk') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                        </div>
                        <div>
                            <div class="flex items-center gap-4 justify-between">
                                <div class="mb-3 w-full">
                                    <label for="stokMasuk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Stok Masuk</label>
                                    <input type="text" name="stokMasuk" id="stokMasuk" value="{{ old('stokMasuk') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                </div>
                                <div>
                                    <span>~</span>
                                </div>
                                <div class="mb-3 w-full">
                                    <label for="stokKeluar" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Stok Keluar</label>
                                    <input type="text" name="stokKeluar" id="stokKeluar" value="{{ old('stokKeluar') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-10">
                            <button type="submit" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Cari</button>
                            <button type="reset" class="text-white bg-red-500 hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-red-500 font-medium rounded-full text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection