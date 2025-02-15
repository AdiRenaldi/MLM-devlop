{{-- gudang utama --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center justify-between bg-white mb-1 rounded dark:bg-gray-800">
            <div class="flex w-5xl md:w-10/12 lg:w-4/12">
                <div class="w-md">
                    <div class="w-full flex flex-wrap md:flex-nowrap">
                        <a href="{{ route('gudang-utama-stok-add') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                        Tambah Stok Gudang
                        </a>
                    </div>
                    <div class="bg-white rounded-lg w-full flex justify-end lg:justify-center">
                        <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                        Hapus Produk
                        </a>
                    </div>
                </div>
                <div class="w-md">
                    <div class="w-full flex flex-wrap md:flex-nowrap">
                        <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                        Pencarian Lanjutan
                        </a>
                    </div>
                    
                    <div class="bg-white rounded-lg w-full flex justify-end lg:justify-center">
                        <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                        Buat Laporan
                        </a>
                    </div>
                </div>
            </div>
            <div class="ms-5 border border-white lg:me-16">
                <div class="text-white bg-main border-b border-main text-sm lg:text-xl block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-t-lg font-bold">SALDO : Rp. {{ number_format($saldo->saldo ?? 0) }}
                </div>
                <div class="flex justify-center items-center text-white bg-main border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white px-5 rounded-b-lg lg:pb-3">
                    <a data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex justify-center items-center focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-2 py-1 me-2 mb-2 mr-2 whitespace-nowrap cursor-pointer">
                        <svg class="w-6 h-6 lg:w-8 lg:h-8 text-blue-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </a>
                    <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex pointer-events-none justify-center items-center focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-2 py-1 me-2 mb-2 mr-2 whitespace-nowrap cursor-pointer">
                        <svg class="w-6 h-6 lg:w-8 lg:h-8 text-yellow-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>


        {{-- <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus hic ipsa, velit praesentium odit voluptas sit ex! Tempora accusantium consectetur aliquam temporibus aliquid qui id accusamus, architecto aut optio iusto?
        </div> --}}


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
            <div class="relative w-full overflow-x-auto scrollbar-thinner pr-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs md:text-sm text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                        <tr>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                <div class="flex items-center justify-center">
                                <input id="checked-checkbox" type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
        
                                </div>
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                ID Produk
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                Nama
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                kategori
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                Harga
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                Jumlah Stok
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                Stok Masuk
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                Expire
                            </th>
                            <th scope="col" class="p-3 whitespace-nowrap text-base text-center text-white border-x border-secondary">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokGudang as $stok)
                            <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    <div class="flex items-center justify-center">
                                        <input type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                                    </div>
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    {{ $stok->kd_stokGudangUtama }}
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    {{ $stok->product->namaProduk }}
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    {{ $stok->product->category }}
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    {{ number_format($stok->product->harga, 0, ',', '.') }}
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    {{ $stok->jumlahStok }}
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center text-black border-x border-secondary">
                                    {{ \Carbon\Carbon::parse($stok->stokMasuk)->format('d-m-Y') }}
                                </td>
                                <td class="p-1 text-base whitespace-nowrap text-center border-x border-secondary {{ \Carbon\Carbon::parse($stok->masaExpire)->isPast() ? 'text-red-700' : 'text-black' }}">
                                    {{ \Carbon\Carbon::parse($stok->masaExpire)->format('d-m-Y') }}
                                </td>
                                <td class="p-1 text-base text-black border-x border-secondary">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('gudang-utama-detail', $stok->kd_stokGudangUtama) }}">
                                            <svg class="w-[30px] h-[30px] text-green-500 hover:text-green-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('gudang-utama-edit', $stok->kd_stokGudangUtama) }}">
                                            <svg class="w-[30px] h-[30px] text-yellow-500 hover:text-yellow-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('gudang-utama-delete', $stok->kd_stokGudangUtama) }}">
                                            <svg class="w-[30px] h-[30px] text-red-500 hover:text-red-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
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
                        Tambah Saldo
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
                    <form method="POST" action="{{ route('gudang-utama-saldo') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="saldo" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nominal Saldo</label>
                            <input type="number" name="saldo" id="saldo" value="{{ old('saldo') }}" class="text-main bg-gray-50 @error('saldo') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('saldo')
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menampilkan modal jika ada error
        @if($errors->any())
            const modal = document.getElementById('default-modal');
            modal.classList.add('flex'); // Menampilkan modal
            modal.classList.remove('hidden'); // Menghapus kelas hidden
        @endif
        
        // Menutup modal ketika area di luar modal diklik
        const modal = document.getElementById('default-modal');
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });
    });
</script>

@endsection