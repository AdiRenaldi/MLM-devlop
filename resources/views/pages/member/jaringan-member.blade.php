@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('member-page') }}">MEMBER</a> -> JARINGAN</h3>
                </div>
                <div class="px-10 mb-8">
                    <div class="flex justify-between w-full">
                        <div class="mb-6">
                            <span class="text-main bg-popup border-b border-main text-lg block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">ID : {{ $member->kd_member }}</span>
                        </div>
                        <div class="mb-6">
                            <span class="text-main bg-popup border-b border-main text-lg block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">NAMA: {{ $member->namaLengkap }}</span>
                        </div>
                        <div class="mb-6">
                            <span class="text-main bg-popup border-b border-main text-lg block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">PANGKAT: {{ $member->pangkat->nama_pangkat }}</span>
                        </div>
                        {{-- <div class="mb-6">
                            <span class="text-main bg-popup border border-main text-lg block w-full dark:bg-gray-700 p-1 dark:border-gray-600 dark:text-white">FOTO</span>
                        </div> --}}
                    </div>
                    <div class="flex">
                        <div class="w-2/4">
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">ATASAN</label>
                                @if ($member->atasan && $member->atasan->count() > 0)
                                    <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->atasan->kd_member }} - {{ $member->atasan->namaLengkap }}</span>
                                @else
                                    <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">Tidak Memiliki Atasan</span>
                                @endif
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">BAWAHAN</label>
                                @if ($member->bawahans && $member->bawahans->count() > 0)
                                    @foreach ($member->bawahans as $item)
                                        <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $item->kd_member }} - {{ $item->namaLengkap }}</span>
                                    @endforeach
                                @else
                                    <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">Tidak Memiliki Bawahan</span>
                                @endif
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></span>
                            </div>
                        </div>
                        <div class="w-2/4 ps-4">
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">UPLINE</label>
                                @if ($member->upline && $member->upline->count() > 0)
                                    <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->upline->kd_member }} - {{ $member->upline->namaLengkap }}</span>
                                @else
                                    <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">Tidak Memiliki Upline</span>
                                @endif
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">DOWNLINES</label>
                                @if ($member->downlines && $member->downlines->count() > 0)
                                    @foreach ($member->downlines as $item)
                                        <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $item->kd_member }} - {{ $item->namaLengkap }}</span>
                                    @endforeach
                                @else
                                    <span class="text-main bg-popup text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">Tidak Memiliki Downline</span>
                                @endif  
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="flex justify-center mt-10">
                        <a href="{{ route('member-edit', $member->kd_member) }}" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Edit Data</a>
                        <button type="submit" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Ganti Password</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</section>
@endsection