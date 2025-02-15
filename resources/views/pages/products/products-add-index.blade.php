@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('product-index') }}">PRODUCT</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idProduk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Stok Gudang</label>
                                <input type="text" name="kd_produk" id="idProduk" value="{{ $products->kd_product }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="mb-3">
                            <label for="nama_produk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" value="{{ isset($products) ? $products->namaProduk : old('nama_produk') }}" class="text-main bg-gray-50 @error('nama_produk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('nama_produk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_produk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Category Produk</label>
                            <input type="text" name="category_produk" id="category_produk" value="{{ isset($products) ? $products->category : old('category_produk') }}" class="text-main bg-gray-50 @error('category_produk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('category_produk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_produk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Harga Produk</label>
                            <input type="number" name="harga_produk" id="harga_produk" value="{{ isset($products) ? $products->harga : old('harga_produk') }}" class="text-main bg-gray-50 @error('harga_produk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('harga_produk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="poin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Poin</label>
                            <select name="poin" id="poin" class="bg-gray-50 @error('poin') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Jenis Poin</option>
                                <option value="platinum" @if (isset($products) && $products->category_poin == 'platinum') selected @endif>Platinum</option>
                                <option value="silver" @if (isset($products) && $products->category_poin == 'silver') selected @endif>Silver</option>
                            </select>
                            @error('poin')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Produk</label>
                            <select name="status_product" id="status_product" class="bg-gray-50 @error('status_product') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Status Produk</option>
                                <option value="1" @if (isset($products) && $products->status == 1) selected @endif>Aktif</option>
                                <option value="0" @if (isset($products) && $products->status == 0) selected @endif>Tidak Aktif</option>
                            </select>
                            @error('status_product')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium dark:text-white" for="file_input">Upload Gambar</label>
                            <input name="image_produk" class="block w-full text-sm text-gray-900 @error('image_produk') border-2 border-red-600 @else border border-gray-300   @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" value="{{ isset($products) ? $products->image : old('image_produk') }}">
                            @error('image_produk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG (MAX. 800x400px).</p>
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