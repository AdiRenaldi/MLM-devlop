{{-- stok --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-10 mt-2 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <div class="w-48 flex flex-wrap md:flex-nowrap">
                    <a href="{{ route('pindah-stok-ToMember') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full w-full text-sm px-8 py-2.5 mb-2 whitespace-nowrap text-center">
                        Kirim Produk
                    </a>
                </div>
            </div>
        </div>
        <div class="flex items-center bg-white justify-center rounded dark:bg-gray-800">
            <div class="w-full flex ms-1 md:ms-16">
                <a href="#"class="text-secondary bg-white border border-secondary focus:outline-none hover:bg-secondary hover:bg-opacity-10 focus:ring-1 focus:ring-secondary font-medium text-sm px-7 py-1 me-4 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Cari ID
                </a>
                <a href="#"class="text-secondary bg-white border border-secondary focus:outline-none hover:bg-secondary hover:bg-opacity-10 focus:ring-1 focus:ring-secondary font-medium text-sm px-7 md:px-16 py-1 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Nama
                </a>
            </div>
        </div>
        <div class="h-full dark:bg-gray-800">
            <div class="relative w-full overflow-x-auto scrollbar-thinner pr-2 pb-1">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs md:text-sm text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            <div class="flex items-center justify-center">
                            <input id="checked-checkbox" type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
    
                            </div>
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            ID Transaksi
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            Nama Stok
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            Pengirim
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            Penerima
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            Qty
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            Tanggal Pengiriman
                        </th>
                        <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                            Status Pengiriman
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manageMember as $item)
                    <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            <div class="flex items-center justify-center">
                                <input id="checked-checkbox" type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                            </div>
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            {{ $item->kd_transaksiMember }}
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            {{ $item->product->namaProduk }}
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            {{ $item->carier }}
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            {{ $item->member->namaLengkap }}
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            {{ $item->qty }}
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            {{ $item->created_at }}
                        </td>
                        <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                            <div class="flex justify-center items-center">
                                <span class="me-5 uppercase font-semibold @if ($item->status_pengiriman == 'packing') bg-gray-200 @elseif ($item->status_pengiriman == 'terkirim') bg-yellow-200 @else bg-komplementer @endif p-1 rounded-lg">{{ $item->status_pengiriman }}</span> 
                                <a data-kode="{{ $item->kd_transaksiMember }}" data-status="{{ $item->status_pengiriman }}" data-modal-target="default-modal" data-modal-toggle="default-modal" class="btn-status flex justify-center items-center focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-2 mt-2 py-1 me-2 mb-2 mr-2 whitespace-nowrap cursor-pointer">
                                    <svg class="w-5 h-5 text-yellow-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="{{ $errors->has('saldo') ? 'flex' : 'hidden' }} fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-popup rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between bg-main p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl text-white font-semibold text-gray-900 dark:text-white">
                        Update Status Pengiriman
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3 text-white hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" action="{{ route('status-pengiriman-ToMember') }}">
                        @csrf
                        <input 
                        type="hidden" 
                        id="kd_menageStock"
                        name="kd_transaksiMember" 
                        value=""
                        />

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
<script src="{{ asset('js/page/stok/stok-gudang.js') }}"></script>
@endsection