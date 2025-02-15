@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('event-page') }}">EVENT</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idEvent" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Event</label>
                                <input type="text" name="kd_event" id="idEvent" value="{{ $event->kd_event }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="mb-3">
                            <label for="nama_event" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Event</label>
                            <input type="text" name="nama_event" id="nama_event" value="{{ isset($event) ? $event->nama_event : old('nama_event') }}" class="text-main bg-gray-50 @error('nama_event') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('nama_event')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_event" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Periode</label>
                            <input type="datetime-local" name="tanggal_event" id="tanggal_event" value="{{ isset($event) ? $event->tanggal_event : old('tanggal_event') }}" class="text-main bg-gray-50 @error('tanggal_event') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('tanggal_event')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium dark:text-white" for="deskripsi">Deskripsi</label>
                            <textarea 
                                    name="deskripsi" 
                                    id="deskripsi"
                                    rows="4" 
                                    class="block w-full p-4 text-main text-sm text-gray-900  @error('deskripsi') border-2 border-red-600 @else border border-gray-300   @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:border-main focus:ring-1 focus:ring-main dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                >{{ isset($event) ? $event->deskripsi : old('deskripsi') }}
                            </textarea>
                            @error('deskripsi')
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