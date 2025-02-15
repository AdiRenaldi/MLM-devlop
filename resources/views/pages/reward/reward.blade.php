{{-- reward --}}
@extends('pages.layouts.layoutMaster')

@section('title','Reward')

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-10 mt-2 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <div class="w-48 flex flex-wrap md:flex-nowrap">
                    <a href="{{ route('reward-add') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full w-full text-sm px-8 py-2.5 mb-2 whitespace-nowrap text-center">
                        Tambah Reward
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
                            ID Reward
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Nama Reward
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Periode
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Poin Silver
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Poin Platinum
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Jumlah
                        </th>
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Status
                        </th>
                        {{-- <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Deskripsi
                        </th> --}}
                        <th scope="col" class="p-3 text-base whitespace-nowrap text-center text-white border-x border-secondary">
                            Aksi
                        </th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($rewards as $reward)
                            <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                                {{-- <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    <div class="flex items-center justify-center">
                                        <input type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                                    </div>
                                </td> --}}
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    {{ $reward->kd_reward }}
                                </td>
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    {{ $reward->nama }}
                                </td>
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    {{ \Carbon\Carbon::parse($reward->tanggalPembuatan)->format('d-m-Y H:i:s') }} - {{ \Carbon\Carbon::parse($reward->tanggalBerakhir)->format('d-m-Y H:i:s') }}

                                </td>
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    {{ $reward->point_silver }}
                                </td>
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    {{ $reward->point_platinum }}
                                </td>
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    {{ $reward->qty }}
                                </td>
                                <td class="p-1 whitespace-nowrap text-center text-black border-x border-secondary flex items-center justify-center">
                                    @if ($reward->tanggalBerakhir >= now())
                                        <svg class="w-[30px] h-[30px] text-blue-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                    @else
                                        <svg class="w-[30px] h-[30px] text-red-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                    @endif
                                </td>
                                {{-- <td class="p-1 text-center whitespace-nowrap text-base text-center text-black border-x border-secondary">
                                    {{ $reward->deskripsi }}
                                </td> --}}
                                <td class="p-1 text-center whitespace-nowrap text-base text-black border-x border-secondary">
                                    <div class="flex justify-center gap-4">
                                        {{-- <a href="#">
                                            <svg class="w-[30px] h-[30px] text-green-500 hover:text-green-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                                            </svg>
                                        </a> --}}

                                        {{-- <a href="{{ route('reward-edit', $reward->kd_reward) }}">
                                            <svg class="w-[30px] h-[30px] text-yellow-500 hover:text-yellow-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                            </svg>
                                        </a> --}}
                                        @php
                                            $isExpired = $reward->tanggalBerakhir < now();
                                        @endphp

                                        <a href="{{ $isExpired ? '#' : route('reward-edit', $reward->kd_reward) }}"
                                        class="w-[30px] h-[30px] {{ $isExpired ? 'pointer-events-none opacity-50' : 'hover:text-yellow-900' }}">
                                            <svg class="w-[30px] h-[30px] text-yellow-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1"
                                                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                            </svg>
                                        </a>




                                        {{-- <a href="{{ route('reward-delete', $reward->kd_reward) }}">
                                            <svg class="w-[30px] h-[30px] text-red-500 hover:text-red-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                            </svg>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection