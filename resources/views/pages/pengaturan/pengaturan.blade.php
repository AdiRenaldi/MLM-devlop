{{-- pengaturan --}}
@extends('pages.layouts.layoutMaster')

@section('title','Pengaturan')

@section('content')
<section id="content" class="w-full flex-grow mt-20">
    <div class="p-2 md:ml-64 min-h-full">
        <div class="flex items-center bg-white justify-center mb-1 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-7 py-2.5 mb-2 whitespace-nowrap">
                Backup Data Login
                </a>
            </div>
        </div>
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-6 py-2.5 mb-2 mr-2 whitespace-nowrap">
                User Class Settings
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
