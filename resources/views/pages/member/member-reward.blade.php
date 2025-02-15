{{-- tambah member --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('member-page') }}">MEMBER</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}">
                        @csrf
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-3 ">
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="" class="w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, nam.</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="" class="w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, nam.</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-3 ">
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="" class="w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, nam.</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="" class="w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, nam.</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center justify-between mb-3 ">
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="" class="w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, nam.</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="" class="w-5 h-5 text-komplementer bg-gray-100 border-gray-300 rounded focus:ring-komplementer dark:focus:ring-komplementer dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox" class="ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, nam.</label>
                                </div>
                            </div>
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

</section>
@endsection