@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-3 rounded dark:bg-gray-800">
            <div class="bg-popup w-10/12 lg:w-7/12 rounded-lg">
                <div class="bg-main w-full px-5 py-4 rounded-t-lg mb-4">
                    <h3 class="text-white"><a href="{{ route('member-page') }}">MEMBER</a> -> DETAIL MEMBER</h3>
                </div>
                <div class="px-10 mb-8">
                    <div class="flex justify-between w-full">
                        <div class="mb-6">
                            <span class="text-main bg-popup border-b border-main text-lg block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">ID : {{ $member->kd_member }}</span>
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
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Nama</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->namaLengkap }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Email</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->userMember->email }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Reward</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @php
                                        $now = now();
                                        $activeRewards = $member->rewards->where('tanggalBerakhir', '>=', $now)->sortBy('tanggalBerakhir');
                                        $expiredRewards = $member->rewards->where('tanggalBerakhir', '<', $now)->sortBy('tanggalBerakhir');
                                        $allRewards = $activeRewards->concat($expiredRewards);
                                    @endphp
                                
                                    @if ($allRewards->isEmpty())
                                        <div>?</div>
                                    @else
                                        @foreach ($allRewards as $index => $item)
                                            <div class="{{ $item->tanggalBerakhir < $now ? 'text-red-500' : '' }}">
                                                {{ $index + 1 }}. {{ $item->nama }}
                                            </div>
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Poin Silver Aktif</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ ($member->poinSilver->silverAktif ?? 0) }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Poin Silver Pasif</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ ($member->poinSilver->silverPasif ?? 0) }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Poin Platinum Aktif</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ ($member->poinPlatinum->platinumAktif ?? 0) }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Poin Platinum Pasif</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ ($member->poinPlatinum->platinumPasif ?? 0) }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Tanggal Masuk</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Tanggal Edit Terakhir</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->updated_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Nomor HP</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->nohp }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Nomor Whatsapp</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->nowhatsapp }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Alamt</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->alamat }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Kecamatan</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->kecamatan->nama }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Kabupaten</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->kabupaten->nama }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Provinsi</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->provinsi->nama }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Kode Pos</label>
                                <span class="text-main bg-popup border-b border-main text-lg block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $member->kodepos }}</span>
                            </div>
                        </div>
                        <div class="w-2/4 ps-4 pt-4">
                            @if ($member->image)
                                <img src="{{ Storage::url('images/member/' . $member->image) }}" 
                                    alt="{{ $member->image }}" 
                                    class="h-64 md:h-80 max-w-full shadow-lg shadow-main rounded-lg">
                            @else
                                <img src="{{ Storage::url('images/member/default/memberDefault.png') }}"
                                    alt="memberDefault.png" 
                                    class="h-64 md:h-80 max-w-full shadow-lg shadow-main rounded-lg">
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-center mt-10">
                        <a href="{{ route('member-edit', $member->kd_member) }}" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Edit Data</a>
                        <button type="submit" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Ganti Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection