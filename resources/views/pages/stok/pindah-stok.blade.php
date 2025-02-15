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
                    <form id="stokForm" method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idStokGudang" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Produk</label>
                                <input type="text" name="kd_stokGudangUtama" id="idStokGudang" value="{{ $stokGudang->kd_stokGudangUtama  }}" class="text-main bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="flex items-center gap-4 justify-between">
                            <div class="mb-3 w-full">
                                <select name="kd_gudangAwal" id="kd_gudangAwal" class="bg-gray-50 @error('kd_gudangAwal') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled class="bg-main text-white">Pilih Lokasi Gudang</option>
                                    @foreach ($gudangs as $gudang)
                                        <option value="{{ $gudang->kd_gudang }}">{{ $gudang->nama_gudang }}</option>
                                    @endforeach
                                </select>
                                @error('kd_gudangAwal')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 flex justify-center items-center">
                                <div class="text-center text-lg font-medium text-gray-900 dark:text-white">To</div>
                            </div>
                            @if($pageConfigs['formTarget']=='pindah-stok-ToGudang')
                                <div class="mb-3 w-full">
                                    <select disabled name="kd_gudangTujuan" id="kd_gudangTujuan" class="bg-gray-50 @error('kd_gudangTujuan') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled class="bg-main text-white">Pilih Tujuan Gudang</option>
                                        @foreach ($gudangs as $gudang)
                                        <option value="{{ $gudang->kd_gudang }}">{{ $gudang->nama_gudang }}</option>
                                        @endforeach
                                    </select>
                                    @error('kd_gudangTujuan')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <div class="mb-3 mt-3 w-full">
                                    <div class="mb-3">
                                        <input type="text" name="idMember" id="idMember" value="{{ isset($stokGudang) ? $stokGudang->stokLokasi : old('idMember') }}" class="text-main bg-gray-50 @error('idMember') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="ID Member" />
                                        @error('idMember')
                                            <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>  
                        <div class="mb-3 w-full">
                            {{-- <label for="namaProduk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gudang Awal</label> --}}
                            <select name="kd_stokGudang" id="namaProduk" class="bg-gray-50 @error('kd_stokGudang') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih Produk</option>
                                    {{-- <option value="">gudang 1</option>
                                    <option value="">gudang 2</option> --}}
                            </select>
                            @error('kd_stokGudang')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="kdProduct" id="kdProduct">
                        <div class="mb-3">
                            <label for="category_produk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Category Produk</label>
                            <input type="text" name="category_produk" id="category_produk" value="{{ isset($stokGudang) ? $stokGudang->product->category : old('category_produk') }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" disabled/>
                        </div>
                        <div class="mb-3">
                            <label for="harga_produk" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Harga Produk</label>
                            <input type="number" name="harga_produk" id="harga_produk" value="{{ isset($stokGudang) ? number_format($stokGudang->product->harga, 0, ',', '') : old('harga_produk') }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" disabled />
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_stok_gudang" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok Gudang</label>
                            <input type="number" name="jumlah_stok_gudang" id="jumlah_stok_gudang" value="{{ isset($stokGudang) ? $stokGudang->jumlahStok : old('jumlah_stok_gudang') }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" disabled/>
                        </div>
                        <div class="mb-3">
                            <label for="total_stok" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Total Stok Dipindahkan</label>
                            <input type="number" name="total_stok" id="total_stok" value="{{ isset($stokGudang) ? $stokGudang->stokLokasi : old('total_stok') }}" class="text-main bg-gray-50 @error('total_stok') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            <div id="error-message" class="text-red-600 hidden">Stok tidak mencukupi</div>
                            @error('total_stok')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 w-full">
                            <label for="lokasi_stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Stok</label>
                            <select name="lokasi_stok" id="lokasi_stok" class="bg-gray-50 @error('lokasi_stok') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih Lokasi Stok</option>
                                @foreach ($gudangs as $gudang)
                                <option value="{{ $gudang->kd_gudang }}">{{ $gudang->nama_gudang }}</option>
                                @endforeach
                            </select>
                            @error('lokasi_stok')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 w-full">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Stok</label>
                            <select name="status" id="status" class="bg-gray-50 @error('status') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih Status Stok</option>
                                <option value="in">IN</option>
                                <option value="out">OUT</option>
                            </select>
                            @error('status')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="carier" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pengirim</label>
                            <input type="text" name="carier" id="carier" value="{{ isset($stokGudang) ? $stokGudang->stokLokasi : old('carier') }}" class="text-main bg-gray-50 @error('carier') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('carier')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_gudang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Pengiriman</label>
                            <select name="status_gudang" id="status_gudang" class="bg-gray-50 @error('status_gudang') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">pilih Status</option>
                                <option value="packing">Packing</option>
                                <option value="terkirim">Terkirim</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            @error('status_gudang')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_kargo" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Harga Kargo</label>
                            <input type="number" name="harga_kargo" id="harga_kargo" value="{{ isset($stokGudang) ? $stokGudang->stokLokasi : old('harga_kargo') }}" class="text-main bg-gray-50 @error('harga_kargo') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('harga_kargo')
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

@section('page-script')
<script src="{{ asset('js/page/pindahStok/pindah-stok.js') }}"></script>
@endsection