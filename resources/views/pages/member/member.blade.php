{{-- member --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('page-style')
<script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('content')
<section id="content" class="w-full h-full mt-20">
<div class="p-2 md:ml-64 h-full">

    <div class="flex flex-wrap md:flex-nowrap flex-col md:flex-row justify-between bg-white rounded dark:bg-gray-800 gap-2">
        <div class="flex w-5xl md:w-10/12 lg:w-4/12">
            <div class="w-md">
                <div class="w-full flex flex-wrap md:flex-nowrap">
                    <a href="{{ route('member-addNew') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                    New Member
                    </a>
                </div>
                <div class="bg-white rounded-lg w-full flex justify-end lg:justify-center">
                    <a href="#" id="btn-reward" data-modal-target="default-modal-reward" data-modal-toggle="default-modal-reward"  class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mr-2 whitespace-nowrap w-full text-center">
                    Beri Reward
                    </a>
                    <a href="#" id="btn-hiden" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mr-2 whitespace-nowrap w-full text-center">
                    Beri Reward
                    </a>
                </div>
            </div>
            <div class="w-md">
                <div class="w-full flex flex-wrap md:flex-nowrap">
                    <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                    Pencarian Lanjutan
                    </a>
                </div>
                
                <div class="bg-white rounded-lg w-full flex justify-end lg:justify-center">
                    <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 md:mb-2 mr-2 whitespace-nowrap w-full text-center">
                    Hapus Member
                    </a>
                </div>
            </div>
        </div>
        <div class="border border-white lg:me-16 border-2 border-komplementer">
            <div class="bg-white rounded-lg w-[170px] md:w-full flex justify-end lg:justify-center">
                <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                Buat Laporan
                </a>
            </div>
            <div class="bg-white rounded-lg w-[170px] md:w-full flex justify-end lg:justify-center">
                <a href="{{ route('member-add') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 me-2 mb-2 mr-2 whitespace-nowrap w-full text-center">
                Add Member
                </a>
            </div>
            
        </div>
    </div>

    <div class="flex items-center mb-3 bg-white rounded dark:bg-gray-800">
        <div class="w-full flex ms-1">
            <form class="w-full max-w-xs md:mx-auto">
                <label for="default-search" class="mb-2 text-base font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <input type="search" name="cari_member" autocomplete="off" id="default-search" value="{{ request('cari_member') }}" 
                        class="block w-full p-2 ps-5 text-sm text-main border border-main rounded-lg bg-popup focus:ring-komplementer focus:border-komplementer dark:bg-gray-700 dark:border-gray-600 placeholder-main dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Search Data"/>
                    
                    <button type="submit" 
                        class="text-white absolute end-3 top-1/2 -translate-y-1/2 bg-komplementer hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Search
                    </button>
                    @error('cari_member')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </form>

        </div>
    </div>
    <div class="h-full dark:bg-gray-800">
        <div class="relative w-full overflow-x-auto scrollbar-thinner pr-2 pb-1">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs md:text-sm text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Pilih
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        ID Member
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Nama
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Pangkat
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Silver Aktif
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Platinum Aktif
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Silver Pasif
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Platinum Pasif
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Reward
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Pohon Jaringan
                    </th>
                    <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($members->isNotEmpty())
                    @foreach ($members as $member)
                    <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                        <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" value="{{ $member->kd_member }}" class="member-checkbox w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                            </div>
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ $member->kd_member }}
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ $member->namaLengkap }}
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ $member->pangkat->nama_pangkat }}
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ ($member->poinSilver->silverAktif ?? 0) }}
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ ($member->poinPlatinum->platinumAktif ?? 0) }}
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ ($member->poinSilver->silverPasif ?? 0) }}
                        </td>
                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            {{ ($member->poinPlatinum->platinumPasif ?? 0) }}
                        </td>
                        <td class="p-1 whitespace-nowrap uppercase text-base text-black border-x border-secondary">
                            @php
                                $now = now();
                                $activeRewards = $member->rewards->where('tanggalBerakhir', '>=', $now)->sortBy('tanggalBerakhir');
                                $expiredRewards = $member->rewards->where('tanggalBerakhir', '<', $now)->sortBy('tanggalBerakhir');
                                $allRewards = $activeRewards->concat($expiredRewards);
                            @endphp
                        
                            @if ($allRewards->isEmpty())
                                <div class="text-center">?</div>
                            @else
                                @foreach ($allRewards as $index => $item)
                                    <div class="{{ $item->tanggalBerakhir < $now ? 'text-red-500' : '' }}">
                                        {{ $index + 1 }}. {{ $item->nama }}
                                    </div>
                                @endforeach
                            @endif
                        </td>

                        <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                            <a href="{{ route('member-jaringan', $member->kd_member) }}" class="text-white bg-komplementer hover:bg-opacity-90 focus:ring-1 focus:ring-komplementer font-medium rounded-lg text-sm px-3 py-1 dark:text-white">Jaringan</a>
                        </td>
                        
                        {{-- <td class="text-black border-x border-secondary text-center">
                            <a href="#" class="inline-block">
                                <svg class="w-[30px] h-[30px] text-blue-500 hover:text-blue-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </td> --}}
                        <td class="px-3 py-3 text-black border-x border-secondary">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('member-detail', $member->kd_member) }}">
                                    <svg class="w-[30px] h-[30px] text-green-500 hover:text-green-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="{{ route('member-edit', $member->kd_member) }}">
                                    <svg class="w-[30px] h-[30px] text-yellow-500 hover:text-yellow-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                </a>
                                <a href="{{ route('member-deleted', $member->kd_member) }}">
                                    <svg class="w-[30px] h-[30px] text-red-500 hover:text-red-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-center text-black py-4 text-sm border border-secondary">Data tidak ditemukan</td>
                    </tr>
                @endif
            </tbody>
            </table>
        </div>
    </div>
</div>
{{-- modal  --}}


<!-- Main modal  pencarian lanjutan-->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-popup rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between bg-main p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl text-white font-semibold text-gray-900 dark:text-white">
                    Pencarian Lanjutan
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
                <form method="POST" action="#">
                    @csrf
                    <div class="mb-3">
                        <label for="namaKota" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
                        <input type="text" name="namaKota" id="namaKota" value="{{ old('namaKota') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                    </div>
                    <div>
                        <label for="" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Poin</label>
                        <div class="flex items-center gap-2 justify-between">
                            <div class="mb-3 w-full">
                                <input type="text" name="poinSilver" id="poinSilver" value="{{ old('poinSilver') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            </div>
                            <div class="mb-3">
                                <span>~</span>
                            </div>
                            <div class="mb-3 w-full">
                                <input type="text" name="poinGold" id="poinGold" value="{{ old('poinGold') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pangkat</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="text-main bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
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

<!-- Main modal beri reward-->
<div id="default-modal-reward" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-popup rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between bg-main p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl text-white font-semibold text-gray-900 dark:text-white">
                    Pilih Reward
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-reward">
                    <svg class="w-3 h-3 text-white hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="px-10 mb-8">
                    <div class="mb-3">
                        <div class="flex flex-wrap justify-between">
                            @foreach($reward as $item)
                                <div class="flex items-center mb-4 w-full md:w-1/2">
                                    <input 
                                        id="checkbox-{{ $loop->index }}" 
                                        type="checkbox" 
                                        name="rewards[]" 
                                        value="{{ $item->kd_reward }}" 
                                        class="reward-checkbox w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-{{ $loop->index }}" class="ms-4 text-base font-medium text-gray-600 dark:text-gray-300">
                                        Nama : {{ $item->nama }} - Qty : {{ $item->qty }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-center mt-10">
                        <button type="button" id="btn-berikan" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Berikan</button>
                        {{-- <button type="reset" class="text-white bg-red-500 hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-red-500 font-medium rounded-full text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@section('page-script')
<script src="{{ asset('js/page/member/member.js') }}"></script>
<script>
    if (window.location.search.includes("cari_member")) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
</script>
@endsection