{{-- gudang cabang --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-10 mt-2 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <div class="w-48 flex flex-wrap md:flex-nowrap">
                    <a href="{{ route('event-add') }}" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-10 py-2.5 mb-2 whitespace-nowrap">
                        Tambah Event
                    </a>
                </div>
            </div>
        </div>

        {{-- <div class="flex items-center bg-white justify-center rounded dark:bg-gray-800">
            <div class="w-full flex ms-1 md:ms-16">
                <a href="#"class="text-secondary bg-white border border-secondary focus:outline-none hover:bg-secondary hover:bg-opacity-10 focus:ring-1 focus:ring-secondary font-medium text-sm px-7 py-1 me-4 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Cari ID
                </a>
                <a href="#"class="text-secondary bg-white border border-secondary focus:outline-none hover:bg-secondary hover:bg-opacity-10 focus:ring-1 focus:ring-secondary font-medium text-sm px-7 md:px-16 py-1 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Nama
                </a>
            </div>
        </div> --}}
        <div class="h-full dark:bg-gray-800">
            <div class="relative w-full h-[30rem] overflow-x-auto scrollbar-thinner pr-2 pb-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs md:text-sm text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                    <tr>
                        {{-- <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            <div class="flex items-center justify-center">
                            <input id="checked-checkbox" type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
    
                            </div>
                        </th> --}}
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            ID Event
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Nama Event
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Tanggal Event
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Undang Member
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Detail Events
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                        {{-- <td class="p-1 text-base text-center text-black border-x border-secondary">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" value="" class="w-5 h-5 rounded focus:ring-0 checked:bg-komplementer border-gray-300">
                            </div>
                        </td> --}}
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            {{ $event->kd_event }}
                        </td>
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            {{ $event->nama_event }}
                        </td>
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            {{ \Carbon\Carbon::parse($event->tanggal_event)->format('d-m-Y') }}
                        </td>
                        <td class="p-5 text-base text-center text-black border-x border-secondary">
                            <a href="#" class="text-white bg-komplementer hover:bg-opacity-90 focus:ring-1 focus:ring-komplementer font-medium rounded-lg text-sm px-3 py-2.5 me-2 dark:text-white">Undang Khusus</a>
                            <a href="{{ route('undangan-full', $event->kd_event) }}" class="text-white bg-komplementer hover:bg-opacity-90 focus:ring-1 focus:ring-komplementer font-medium rounded-lg text-sm px-3 py-2.5 dark:text-white">Undang Semua</a>
                        </td>
                        <td class="p-5 text-base text-center text-black border-x border-secondary">
                            <a href="{{ route('event-detail', $event->kd_event) }}" class="text-white bg-komplementer hover:bg-opacity-90 focus:ring-1 focus:ring-komplementer font-medium rounded-lg text-sm px-3 py-2.5 me-2 dark:text-white">Detail Events</a>
                        </td>
                        <td class="p-1 text-base text-black border-x border-secondary">
                            <div class="flex justify-center gap-4">
                                {{-- <a href="#">
                                    <svg class="w-[30px] h-[30px] text-green-500 hover:text-green-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                                    </svg>
                                </a> --}}
                                <a href="#">
                                    <svg class="w-[30px] h-[30px] text-yellow-500 hover:text-yellow-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                </a>
                                <a href="#">
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
    </section>
@endsection