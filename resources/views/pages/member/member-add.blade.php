{{-- tambah member --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')

@section('page-style')
    <script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
@endsection

<section id="content" class="w-full min-h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('member-page') }}">MEMBER</a> -> <span class="uppercase">{{ $pageConfigs['title'] }}</span></h3>
                </div>
                <div class="px-10 mb-8">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form method="POST" action="{{ route($pageConfigs['formTarget'], Route::current()->parameter('id')) }}" enctype="multipart/form-data">
                        @csrf
                        @if($pageConfigs['pageType']=='edit')
                            @method('PUT')
                            <div class="mb-6">
                                <label for="kdmember" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">ID Member</label>
                                <input type="text" name="kdmember" id="kdmember" value="{{ $member->kd_member }}" class="text-main bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-44 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" disabled/>
                            </div> 
                        @endif
                        <div class="mb-3">
                            <label for="userName" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                            <input type="text" name="namaLengkap" id="userName" value="{{ isset($member) ? $member->namaLengkap : old('namaLengkap') }}" class="text-main bg-gray-50 @error('namaLengkap') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('namaLengkap')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($pageConfigs['pageType']=='add' || $pageConfigs['pageType']=='addNew')
                            <div class="mb-3">
                                <div class="flex items-center space-x-2">
                                    <div class="flex-1">
                                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="text-main bg-gray-50 @error('email') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                        @if($pageConfigs['pageType']=='add' || $pageConfigs['pageType']=='edit')
                                        @error('email')
                                            <div class="text-red-600 text-sm mt-1">{{ $message }}
                                            </div>
                                        @enderror
                                        @endif
                                    </div>
                                    @if($pageConfigs['pageType']=='addNew')
                                    <div class="flex-none w-1/4">
                                        <label for="confirmation_code" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Minta kode</label>
                                        <input type="text" name="confirmation_code" id="confirmation_code" class="text-main bg-gray-50 @error('confirmation_code') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="# 6 Digit" maxlength="6" />
                                        @error('confirmation_code')
                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="flex-none">
                                        <button type="button" class="bg-main text-white px-4 py-2 mt-6 rounded-lg focus:outline-none hover:bg-main-dark">Send</button>
                                    </div>
                                    @endif
                                </div>
                                @if($pageConfigs['pageType']=='addNew')
                                        @error('email')
                                            <div class="text-red-600 text-sm mt-1">{{ $message }}
                                            </div>
                                @enderror
                                @endif
                            </div>
                            <div class="mb-3 flex items-center space-x-2">
                                <div class="flex-1">
                                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password Awal</label>
                                    <input type="password" name="password" id="password" class="text-main bg-gray-50 @if($errors->has('password') || $errors->has('passwordConfirm')) border-2 border-red-600 @else border border-gray-300 @endif text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                    @error('password')
                                        <div class="text-red-600 block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="flex-1">
                                    <label for="passwordConfirm" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password Verifikasi</label>
                                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="text-main bg-gray-50 @error('passwordConfirm') border-2 border-red-600 @else border border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                    @error('passwordConfirm')
                                        <div class="text-red-600 block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                            <div class="mb-3">
                                <label for="pangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pangkat Member</label>
                                <select name="pangkat" id="pangkat" class="bg-gray-50 @error('pangkat') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled class="bg-main text-white">Pilih Pangkat</option>
                                    @foreach($pangkat as $p)
                                        <option value="{{ $p->kd_pangkat }}" 
                                            @if(isset($member) && $member->pangkat->kd_pangkat == $p->kd_pangkat) selected @endif>
                                            {{ $p->nama_pangkat }}
                                        </option>
                                    @endforeach
    
                                </select>
                                @error('pangkat')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        @if($pageConfigs['pageType']=='add' || $pageConfigs['pageType']=='addNew')    
                            <div class="mb-3">
                                <div class="flex items-center space-x-2">
                                    <div class="flex-1">
                                        <label for="upline_utama" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Upline Utama (wajib)</label>
                                        <input type="text" name="upline_utama" id="upline_utama" value="{{ isset($member) ? $member->upline_utama : old('upline_utama') }}" class="text-main bg-gray-50 @error('upline_utama') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                        {{-- @error('upline_utama')
                                            <div class="text-red-600">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                    <div class="flex-1">
                                        <label for="upline_atasan" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Atasan (optional)</label>
                                        <input type="text" name="upline_atasan" id="upline_atasan" value="{{ isset($member) ? $member->upline_atasan : old('upline_atasan') }}" class="text-main bg-gray-50 @error('upline_atasan') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                        {{-- @error('upline_atasan')
                                            <div class="text-red-600">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                                @error('upline_utama')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        {{-- <div class="w-4/5"> --}}
                            <div class="mb-3">
                                <label for="nomorHp" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nomor HP</label>
                                <div class="flex">
                                    {{-- <span class="inline-flex items-center px-3 text-sm text-main bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                        +62
                                    </span> --}}
                                    <input type="number" name="nomorHp" id="nomorHp" value="{{ isset($member) ? $member->nohp : old('nomorHp') }}" class="text-main bg-gray-50 @error('nomorHp') border-2 border-red-600 @else border border-gray-300 @enderror text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                </div>
                                @error('nomorHp')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Contoh: 628xxxx / 081xxxx.</p>
                            </div>
                            <div class="mb-3">
                                <label for="nomorWa" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nomor Whatsapp</label>
                                <div class="flex">
                                    {{-- <span class="inline-flex items-center px-3 text-sm text-main bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                        +62
                                    </span> --}}
                                    <input type="number" name="nomorWa" id="nomorWa" value="{{ isset($member) ? $member->nowhatsapp : old('nomorWa') }}" class="text-main bg-gray-50 @error('nomorWa') border-2 border-red-600 @else border border-gray-300   @enderror text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                                </div>
                                @error('nomorWa')
                                <div class="text-red-600">{{ $message }}</div>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Contoh: 628xxxx / 081xxxx.</p>
                            </div>
                        {{-- </div> --}}
                        <div class="mb-3">
                            <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ isset($member) ? $member->alamat : old('alamat') }}" class="text-main bg-gray-50 @error('alamat') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('alamat')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- @dd($member->provinsi, $provinsi); --}}
                        <div class="mb-3">
                            <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="bg-gray-50 @error('provinsi') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih Provinsi</option>
                                @foreach($provinsi as $p)
                                    <option value="{{ $p->id }}" 
                                        @if(isset($member) && $member->provinsi->id == $p->id) selected @endif>
                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" @if($pageConfigs['pageType']=='add' || $pageConfigs['pageType']=='addNew') disabled @endif class="bg-gray-50 @error('kabupaten') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih Kabupaten</option>
                                @if(isset($member))
                                    @foreach($kabupaten as $k)
                                        <option value="{{ $k->id }}" {{ isset($member) && $member->kabupaten->id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kabupaten')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" @if($pageConfigs['pageType']=='add' || $pageConfigs['pageType']=='addNew') disabled @endif class="bg-gray-50 @error('kecamatan') border-2 border-red-600 @else border border-gray-300 @enderror text-main text-sm rounded-lg focus:border-main focus:ring-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled class="bg-main text-white">Pilih kecamatan</option>
                                @if(isset($member))
                                    @foreach($kecamatan as $k)
                                        <option value="{{ $k->id }}" {{ isset($member) && $member->kecamatan->id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kecamatan')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="kode-pos" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
                            <input type="number" name="kodePos" id="kode-pos" value="{{ isset($member) ? $member->kodepos : old('kodePos') }}" class="text-main bg-gray-50 @error('kodePos') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" placeholder="" />
                            @error('kodePos')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- @if($pageConfigs['pageType']=='edit')
                            <div>
                                <div class="mb-3">
                                    FOTO
                                </div>
                            </div>
                        @endif --}}
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
    <script src="{{ asset('js/page/member/member-add.js') }}"></script>
@endsection