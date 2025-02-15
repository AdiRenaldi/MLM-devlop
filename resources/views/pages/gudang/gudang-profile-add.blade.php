@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('product-index') }}">GUDANG</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idGudang" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Gudang</label>
                                <input type="text" name="kd_gudang" id="idGudang" value="{{ $gudang->kd_gudang }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="mb-3">
                            <label for="nama_gudang" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Gudang</label>
                            <input type="text" name="nama_gudang" id="nama_gudang" value="{{ isset($gudang) ? $gudang->nama_gudang : old('nama_gudang') }}" class="text-main bg-gray-50 @error('nama_gudang') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('nama_gudang')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="identitas_gudang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Identitas Gudang</label>
                            <select name="identitas_gudang" id="identitas_gudang" class="bg-gray-50 @error('identitas_gudang') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Status Produk</option>
                                <option value="0" {{ isset($gudang) && $gudang->identitas == 0 ? 'selected' : '' }}>Gudang Utama</option>
                                <option value="1" {{ isset($gudang) && $gudang->identitas == 1 ? 'selected' : '' }}>Gudang Cabang</option>
                            </select>
                            @error('identitas_gudang')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_gudang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Gudang</label>
                            <select name="status_gudang" id="status_gudang" class="bg-gray-50 @error('status_gudang') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Status</option>
                                <option value="0" {{ isset($gudang) && $gudang->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="1" {{ isset($gudang) && $gudang->status == 1 ? 'selected' : '' }}>Aktif</option>
                            </select>
                            @error('status_gudang')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex justify-center mt-10">
                            <button type="submit" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Simpan</button>
                            <button type="reset" class="text-white bg-red-500 hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-red-500 font-medium rounded-full text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection