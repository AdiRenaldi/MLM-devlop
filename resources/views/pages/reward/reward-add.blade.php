@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('reward-page') }}">REWARD</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idReward" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Reward</label>
                                <input type="text" name="kd_reward" id="idReward" value="{{ $reward->kd_reward }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="mb-3">
                            <label for="nama_reward" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Reward</label>
                            <input type="text" name="nama_reward" id="nama_reward" value="{{ isset($reward) ? $reward->nama : old('nama_reward') }}" class="text-main bg-gray-50 @error('nama_reward') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('nama_reward')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_reward" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Jumlah Reward</label>
                            <input type="number" name="jumlah_reward" id="jumlah_reward" value="{{ isset($reward) ? $reward->qty : old('jumlah_reward') }}" class="text-main bg-gray-50 @error('jumlah_reward') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('jumlah_reward')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="periode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Periode Reward</label>
                            <div class="flex items-center gap-2 justify-between">
                                <div class="mb-3 w-full">
                                    <input type="datetime-local" name="periode_awal" id="periode" value="{{ isset($reward) ? $reward->tanggalPembuatan : old('periode_awal') }}" class="text-main bg-gray-50 @error('periode_awal') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                    @error('periode_awal')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <span>~</span>
                                </div>
                                <div class="mb-3 w-full">
                                    <input type="datetime-local" name="periode_akhir" id="periode" value="{{ isset($reward) ? $reward->tanggalBerakhir : old('periode_akhir') }}" class="text-main bg-gray-50  @error('periode_akhir') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                    @error('periode_akhir')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="periode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Syarat Jumlah Poin</label>
                            <div class="flex items-center gap-2 justify-between">
                                <div class="mb-3 w-full">
                                    <input type="number" name="point_silver" id="point_silver" value="{{ isset($reward) ? $reward->point_silver : old('point_silver') }}" class="text-main bg-gray-50 @error('point_silver') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="Point Silver" />
                                    @error('point_silver')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <span>~</span>
                                </div>
                                <div class="mb-3 w-full">
                                    <input type="number" name="point_platinum" id="point_platinum" value="{{ isset($reward) ? $reward->point_platinum : old('point_platinum') }}" class="text-main bg-gray-50 @error('point_platinum') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="Point Platinum" />
                                    @error('point_platinum')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium dark:text-white" for="file_input">Upload Gambar</label>
                            <input name="image_reward" class="block w-full text-sm text-gray-900 @error('image_reward') border-2 border-red-600 @else border border-gray-300   @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" value="{{ isset($reward) ? $reward->image : old('image_reward') }}">
                            @error('image_reward')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG (MAX. 800x400px).</p>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-2 text-sm font-medium dark:text-white" for="deskripsi">Deskripsi</label>
                            <textarea 
                                    name="deskripsi" 
                                    id="deskripsi"
                                    rows="4" 
                                    class="block w-full p-4 text-main text-sm text-gray-900  @error('deskripsi') border-2 border-red-600 @else border border-gray-300   @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:border-main focus:ring-1 focus:ring-main dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                >{{ isset($reward) ? $reward->deskripsi : old('deskripsi') }}
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