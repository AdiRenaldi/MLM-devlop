{{-- Promo --}}
@extends('pages.layouts.layoutMaster')

@section('title','Promo')

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-10 mt-2 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <div class="w-48 flex flex-wrap md:flex-nowrap">
                    <a href="{{ route('promo-add') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full w-full text-sm px-8 py-2.5 mb-2 whitespace-nowrap text-center">
                        Tambah Promo
                    </a>
                </div>
                {{-- <div class="w-48 flex flex-wrap md:flex-nowrap lg:ms-2">
                    <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full w-full text-sm px-8 py-2.5 mb-2 whitespace-nowrap text-center">
                        Pencarian Lanjutan
                    </a>
                </div> --}}
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
                        {{-- <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            <div class="flex items-center justify-center">
                                <input checked disabled type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                            </div>
                        </th> --}}
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            ID Promo
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Gambar
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Nama Promo
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Slider
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Dashboard
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Deskripsi
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promo as $item)
                        <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                            {{-- <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                                <div class="flex items-center justify-center">
                                    <input type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                                </div>
                            </td> --}}
                            <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                                {{ $item->kd_promo }}
                            </td>
                            <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                                <div class="flex items-center justify-center">
                                    <img src="{{ Storage::url('images/promo/'.$item->gambar) }}" alt="" class="w-20 h-20">
                                </div>
                            </td>
                            <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                                {{ $item->nama_promo }}
                            </td>
                            <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                                <div class="flex justify-center items-center">
                                    <span class="me-5 uppercase font-semibold @if ($item->status == '1') text-komplementer @else text-red-500 @endif p-1 rounded-lg">{{ $item->status == '1' ? 'Aktif' : 'Tidak Aktif' }}</span> 

                                    <a data-kode="{{ $item->kd_promo }}" data-status="{{ $item->status }}" data-modal-target="default-slide"  id="btn-status" data-modal-toggle="default-slide" class="btn-status flex justify-center items-center focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-2 mt-2 py-1 me-2 mb-2 mr-2 whitespace-nowrap cursor-pointer">
                                        <svg class="w-5 h-5 text-yellow-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                            <td class="p-1 whitespace-nowrap text-center text-base text-black border-x border-secondary">
                                <div class="flex justify-center items-center">
                                    <span class="me-5 uppercase font-semibold @if ($item->type == '1') text-komplementer @else text-red-500 @endif p-1 rounded-lg">{{ $item->type == 1 ? 'Aktif' : 'Tidak Aktif' }}</span> 

                                    <a data-kode="{{ $item->kd_promo }}" data-status="{{ $item->type }}" data-modal-target="default-modal"  id="btn-type" data-modal-toggle="default-modal" class="btn-status flex justify-center items-center focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-2 mt-2 py-1 me-2 mb-2 mr-2 whitespace-nowrap cursor-pointer">
                                        <svg class="w-5 h-5 text-yellow-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                            <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                                {{ $item->deskripsi }}
                            </td>
                            <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('promo-detail', $item->kd_promo) }}">
                                        <svg class="w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] text-green-500 hover:text-green-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('promo-edit', $item->kd_promo) }}">
                                        <svg class="w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] text-yellow-500 hover:text-yellow-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('promo-delete', $item->kd_promo) }}">
                                        <svg class="w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] text-red-500 hover:text-red-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
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

    <!-- Main modal slide -->
    <div id="default-slide" tabindex="-1" aria-hidden="true" class="{{ $errors->has('status') ? 'flex' : 'hidden' }} fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-popup rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between bg-main p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl text-white font-semibold text-gray-900 dark:text-white">
                        Tampil Slide
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-slide">


                        <svg class="w-3 h-3 text-white hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" action="{{ route('promo-slide') }}">
                        @csrf
                        <input 
                        type="hidden" 
                        id="kd_promo"
                        name="kd_promo" 
                        value=""
                        />

                        <div class="mb-3">
                            <select name="status" id="status" class="bg-gray-50 @error('status') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('status')
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

    <!-- Main modal dashboard -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="{{ $errors->has('type') ? 'flex' : 'hidden' }} fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-popup rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between bg-main p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl text-white font-semibold text-gray-900 dark:text-white">
                        Tampil Dashboard
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
                    <form method="POST" action="{{ route('promo-dashboard') }}">
                        @csrf
                        <input 
                        type="hidden" 
                        id="kd_promo_type"
                        name="kd_promo" 
                        value=""
                        />

                        <div class="mb-3">
                            <select name="type" id="type" class="bg-gray-50 @error('type') border-2 border-red-600 @else border border-gray-300   @enderror  text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('type')
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
<script src="{{ asset('js/page/promo/promo.js') }}"></script>
@endsection