{{-- tambah member --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('page-style')
<script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('gudang-utama') }}">GUDANG UTAMA</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idStokGudang" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Produk</label>
                                <input type="text" name="kd_stokGudangUtama" id="idStokGudang" value="{{ $stokGudang->kd_stokGudangUtama  }}" class="text-main bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        {{-- <div class="mb-3">
                            <label for="namaProduk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                            <input type="text" name="nama_produk" id="namaProduk" autocomplete="off" value="{{ isset($stokGudang) ? $stokGudang->product->namaProduk : old('namaProduk') }}" class="text-main bg-gray-50 @error('namaProduk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('namaProduk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for="namaProduk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                            <select name="kd_product" id="namaProduk" class="bg-gray-50 @error('namaProduk') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih Produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->kd_product }}" category="{{ $product->category }}"harga="{{ $product->harga }}"
                                        @if (isset($stokGudang) && $stokGudang->product->kd_product == $product->kd_product) selected @endif
                                        >{{ $product->namaProduk }}</option>
                                @endforeach
                            </select>
                            @error('namaProduk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="categoryProduk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Category Produk</label>
                            <input type="text" name="category_produk" id="categoryProduk" value="{{ isset($stokGudang) ? $stokGudang->product->category : old('category_produk') }}" class="text-main bg-gray-300 @error('category_produk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" disabled placeholder="" />
                            @error('category_produk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="hargaProduk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Harga Produk</label>
                            <input type="number" name="harga_produk" id="hargaProduk" value="{{ isset($stokGudang) ? number_format($stokGudang->product->harga, 0, ',', '') : old('harga_produk') }}" class="text-main bg-gray-300 @error('harga_produk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" disabled placeholder="" />
                            @error('harga_produk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_stok" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" id="jumlah_stok" value="{{ isset($stokGudang) ? $stokGudang->jumlahStok : old('jumlah_stok') }}" class="text-main bg-gray-50 @error('jumlah_stok') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('jumlah_stok')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stokMasuk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Stok Masuk</label>
                            <input type="date" name="stok_masuk" id="stokMasuk" value="{{ isset($stokGudang) && $stokGudang->stokMasuk ? \Carbon\Carbon::parse($stokGudang->stokMasuk)->format('Y-m-d') : old('stok_masuk') }}" class="text-main bg-gray-50 @error('stok_masuk') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('stok_masuk')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="masaExpire" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Masa Expire</label>
                            <input type="date" name="masa_expire" id="masaExpire" value="{{ isset($stokGudang) && $stokGudang->masaExpire ? \Carbon\Carbon::parse($stokGudang->masaExpire)->format('Y-m-d') : old('masa_expire') }}" class="text-main bg-gray-50 @error('masa_expire') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('masa_expire')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok_lokasi" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Lokasi Stok</label>
                            <input type="text" name="stok_lokasi" id="stok_lokasi" value="{{ isset($stokGudang) ? $stokGudang->stokLokasi : old('stok_lokasi') }}" class="text-main bg-gray-50 @error('stok_lokasi') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('stok_lokasi')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium dark:text-white" for="deskripsi">Deskripsi Produk</label>
                            <textarea 
                                    name="deskripsi" 
                                    id="deskripsi"
                                    rows="5" 
                                    class="block w-full p-4 text-main text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:border-main focus:ring-1 focus:ring-main dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                >{{ isset($stokGudang) ? $stokGudang->deskripsi : old('deskripsi') }}
                            </textarea>
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

@section('page-script')
<script>
    var urlProduct = "{{ route('product-list') }}";
</script>
<script src="{{ asset('js/page/gudangUtama/gudang-utama.js') }}"></script>
@endsection