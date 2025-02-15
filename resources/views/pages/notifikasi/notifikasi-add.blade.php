@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

@section('page-style')
    <script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
@endsection

<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-6/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('notifikasi-page') }}">NOTIFIKASI</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="idNotifikasi" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Notifikasi</label>
                                <input type="text" name="kd_notifikasi" id="idNotifikasi" value="{{ $notifikasi->kd_notifikasi }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="mb-5">
                            <label for="nama_notifikasi" class="block mb-1 text-base font-medium text-gray-900 dark:text-white">NAMA NOTIFIKASI</label>
                            <input type="text" name="nama_notifikasi" id="nama_notifikasi" value="{{ isset($notifikasi) ? $notifikasi->nama_notifikasi : old('nama_notifikasi') }}" class="text-main bg-gray-50 @error('nama_notifikasi') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('nama_notifikasi')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label class="block mb-2 text-base font-medium dark:text-white" for="file_input">GAMBAR NOTIFIKASI</label>
                            <input name="image_notifikasi" class="block w-full text-sm text-gray-900 @error('image_notifikasi') border-2 border-red-600 @else border border-gray-300   @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" value="{{ isset($notifikasi) ? $notifikasi->image : old('image_notifikasi') }}">
                            @error('image_notifikasi')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG (MAX. 800x400px).</p>
                        </div>
                        <div class="mb-5">
                            <label class="block mb-2 text-base font-medium dark:text-white" for="pesan_notifikasi">PESAN NOTIFIKASI</label>
                            <textarea 
                                    name="pesan_notifikasi" 
                                    id="pesan_notifikasi"
                                    rows="3" 
                                    class="block w-full p-4 text-main text-sm text-gray-900  @error('pesan_notifikasi') border-2 border-red-600 @else border border-gray-300   @enderror rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:border-main focus:ring-1 focus:ring-main dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                >{{ isset($notifikasi) ? $notifikasi->pesan_notifikasi : old('pesan_notifikasi') }}
                            </textarea>
                            @error('pesan_notifikasi')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="filterMember" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">PENERIMA NOTIFIKASI</label>
                                <select name="penerima" id="filterMember" class="bg-gray-50 @error('penerima') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled class="bg-main text-white">Pilih Penerima</option>
                                    {{-- @foreach($penerima as $p) --}}
                                        <option value="0">Semua Member</option>
                                        <option value="1">Satu Member</option>
                                        <option value="2">Berdasarkan Poin Member</option>
                                    {{-- @endforeach --}}

                                </select>
                                @error('penerima')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <label for="periode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">TRIGGER</label> --}}
                            <div id="penerimaNotifikasi" class="bg-gray-200 p-3 mb-5 rounded-lg shadow-lg dark:shadow-gray-700">
                                <div class="flex items-center gap-10 justify-between">
                                    <div class="mb-3 w-full">
                                        <label for="nama_notifikasi" class="block mb-1 text-base font-medium text-main dark:text-white">Penerima Notifikasi</label>
                                        <input type="number" name="member" id="member" disabled value="{{ isset($notifikasi) ? $notifikasi->member : old('member') }}" class="text-main bg-gray-300 @error('member') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="Id Member" />
                                        @error('member')
                                            <div class="text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="flex flex-wrap justify-between">
                                        <div class="flex items-center mb-2 w-full md:w-1/2">
                                            <label for="poin_check" class="hidden md:block text-base font-medium text-main dark:text-gray-300">
                                                Poin
                                            </label>
                                        </div>
                                    </div>
    
                                    <div class="flex flex-wrap md:flex-nowrap items-center gap-2 justify-between">
                                        <div class="md:mb-3 w-full">
                                            <label for="poin_silver" class="block md:hidden text-base font-medium text-main dark:text-gray-300">
                                                Poin Silver
                                            </label>
                                            <input type="number" name="poin_silver" id="poin_silver" disabled value="{{ isset($notifikasi) && $notifikasi->poin_silver ? $notifikasi->poin_silver : old('poin_silver') }}" class="text-main bg-gray-300 @error('poin_silver') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="Poin Silver" />
                                            @error('poin_silver')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 hidden md:block">
                                            <span>~</span>
                                        </div>
                                        <div class="md:mb-3 w-full">
                                            <label for="poin_platinum" class="block md:hidden text-base font-medium text-main dark:text-gray-300">
                                                Poin Platinum
                                            </label>
                                            <input type="number" name="poin_platinum" id="poin_platinum" disabled value="{{ isset($notifikasi) && $notifikasi->poin_platinum ? $notifikasi->poin_platinum : old('poin_platinum') }}" class="text-main bg-gray-300  @error('poin_platinum') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="Poin Platinum"/>
                                            @error('poin_platinum')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="filterPengiriman" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">TIPE NOTIFIKASI</label>
                                <select name="tipe_notifikasi" id="filterPengiriman" class="bg-gray-50 @error('tipe_notifikasi') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled class="bg-main text-white">Pilih Tipe</option>
                                    {{-- @foreach($tipe_notifikasi as $p) --}}
                                        <option value="0">Kirim Otomatis</option>
                                        <option value="1">Tanggal Dikirim</option>
                                        <option value="2">Periode Tanggal</option>
                                    {{-- @endforeach --}}
    
                                </select>
                                @error('tipe_notifikasi')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="pengirimanNotifikasi" class="bg-gray-200 p-3 mb-5 rounded-lg shadow-lg dark:shadow-gray-700">
                                <div class="md:mb-5">
                                    <label for="poin_check" class="text-base font-medium text-main dark:text-gray-300">
                                        Tanggal pengiriman
                                    </label>
                                    <div class="flex items-center gap-10 justify-between mt-2">
                                        <div class="w-full">
                                            <input type="datetime-local" name="tanggal_eksekusi" id="tanggal_eksekusi" disabled value="{{ isset($notifikasi) && $notifikasi->tanggal_eksekusi ? \Carbon\Carbon::parse($notifikasi->tanggal_eksekusi)->format('Y-m-d') : old('tanggal_eksekusi') }}" class="text-main bg-gray-300 @error('tanggal_eksekusi') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                            @error('tanggal_eksekusi')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="flex flex-wrap justify-between">
                                        <div class="flex items-center mb-2 w-full md:w-1/2">
                                            <label for="periode_check" class="hidden md:block text-base font-medium text-main dark:text-gray-300">
                                                Periode
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap md:flex-nowrap items-center gap-2 justify-between">
                                        <div class="w-full md:mb-3">
                                            <label for="periode_awal" class="block md:hidden text-base font-medium text-main dark:text-gray-300">
                                                Tanggal Mulai
                                            </label>
                                            <input type="datetime-local" name="periode_awal" id="periode_awal" disabled value="{{ isset($notifikasi) && $notifikasi->tanggal_eksekusi ? \Carbon\Carbon::parse($notifikasi->tanggal_eksekusi)->format('Y-m-d') : old('tanggal_eksekusi') }}" class="text-main bg-gray-300 @error('periode_awal') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                            @error('periode_awal')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-1 hidden md:block">
                                            <span>~</span>
                                        </div>
                                        <div class="w-full md:mb-3">
                                            <label for="periode_akhir" class="block md:hidden text-base font-medium text-main dark:text-gray-300">
                                                Tanggal Berakhir
                                            </label>
                                            <input type="datetime-local" name="periode_akhir" id="periode_akhir" disabled value="{{ isset($notifikasi) && $notifikasi->tanggal_eksekusi ? \Carbon\Carbon::parse($notifikasi->tanggal_eksekusi)->format('Y-m-d') : old('tanggal_eksekusi') }}" class="text-main bg-gray-300  @error('periode_akhir') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                            @error('periode_akhir')
                                                <div class="text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="jadwal" class="text-base font-medium text-main dark:text-gray-300">
                                        Jadwal Pengiriman
                                    </label>
                                    <select name="jadwal" id="jadwal" disabled class="mt-2 bg-gray-300 @error('jadwal') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled class="bg-main text-white">Pilih Jadwal</option>
                                        {{-- @foreach($jadwal as $p) --}}
                                            <option value="0">Harian</option>
                                            <option value="1">Mingguan</option>
                                            <option value="2">Bulanan</option>
                                        {{-- @endforeach --}}
        
                                    </select>
                                    @error('jadwal')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-10">
                            <button type="submit" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Kirim</button>
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
    <script src="{{ asset('js/page/notifikasi/notifikasi-add.js') }}"></script>
@endsection