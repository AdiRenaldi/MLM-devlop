{{-- gudang cabang --}}
@extends('pages.layouts.layoutMaster')

@section('title',$pageConfigs['title'])

@section('page-style')
    <script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('content')
<section id="content" class="w-full h-full mt-20">
    <div class="p-2 md:ml-64 h-full">
        <div class="flex items-center bg-white justify-center mb-10 mt-2 rounded dark:bg-gray-800">
            <div class="w-full flex flex-wrap md:flex-nowrap">
                <div class="w-48 flex flex-wrap md:flex-nowrap">
                    <a href="#" class="focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-10 py-2.5 mb-2 whitespace-nowrap">
                        Scan Kehadiran
                    </a>
                </div>
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
        <div class="bg-white justify-center rounded dark:bg-gray-800">
            <div>{{ $events->kd_event }}</div>
            <div>{{ $events->nama_event }}</div>
            <div>{{ $events->tanggal_event }}</div>
            <div>{{ $events->deskripsi }}</div>
        </div>
        <div class="h-full dark:bg-gray-800">
            <div class="relative w-full h-[30rem] overflow-x-auto scrollbar-thinner pr-2 pb-2">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs md:text-sm text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            ID Member
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Nama Member
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Pangkat
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Nomor Kursi
                        </th>
                        <th scope="col" class="py-3 text-base text-center text-white border-x border-secondary">
                            Kehadiran
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events->members as $member)
                    <tr class="bg-popup hover:bg-opacity-50 dark:bg-gray-800">
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            {{ $member->kd_member }}
                        </td>
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            {{ $member->namaLengkap }}
                        </td>
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            {{ $member->pangkat->nama_pangkat }}
                        </td>
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            <div class="flex justify-center items-center">
                                <span class="me-5 uppercase font-semibold"> {{ $member->pivot->nomor_kursi }} </span>
                                <span data-kode="{{ $member->kd_member }}" data-nama="{{ $member->namaLengkap }}" data-pangkat="{{ $member->pangkat->nama_pangkat }}" data-kursi="{{ $member->pivot->nomor_kursi }}" data-event="{{ $events->kd_event }}" data-modal-target="default-modal" data-modal-toggle="default-modal" class="btn-status flex justify-center items-center focus:outline-none text-white bg-komplementer hover:bg-opacity-80 focus:ring-1 focus:ring-komplementer font-medium rounded-full text-sm px-2 mt-2 py-1 me-2 mb-2 mr-2 whitespace-nowrap cursor-pointer">
                                    <svg class="w-5 h-5 text-yellow-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                </span>
                            </div>
                        </td>
                        <td class="p-1 text-base text-center text-black border-x border-secondary">
                            belum
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true" class="{{ $errors->has('saldo') ? 'flex' : 'hidden' }} fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-popup rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between bg-main p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl text-white font-semibold text-gray-900 dark:text-white">
                            Update Nomor Kursi
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3 text-white hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form method="POST" action="{{ route('ubah-nomor-kursi') }}">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $events->kd_event }}">
                            <div class="mb-3">
                                <label for="kode_member" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kode Member</label>
                                <input type="text" name="kd_member" id="kode_member" value="{{ old('kode_member') }}" class="text-main bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main pointer-events-none" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="nama_member" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nama Member</label>
                                <input type="text" name="nama_member" id="nama_member" value="{{ old('nama_member') }}" class="text-main bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main pointer-events-none" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="pangkat_member" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Pangkat Member</label>
                                <input type="text" name="pangkat_member" id="pangkat_member" value="{{ old('pangkat_member') }}" class="text-main bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main pointer-events-none" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="nomor_kursi" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nomor Kursi</label>
                                <input type="number" name="nomor_kursi" id="nomor_kursi" value="{{ old('nomor_kursi') }}" class="text-main bg-gray-50 @error('nomor_kursi') border-2 border-red-600 @else border border-gray-300   @enderror text-gray-900 text-sm rounded-lg focus:ring-main focus:border-main block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-main" />
                                @error('nomor_kursi')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex justify-center mt-10">
                                <button type="submit" class="text-white bg-komplementer rounded-full hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-komplementer font-medium text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Simpan</button>
                                {{-- <button type="reset" id="resetForm" class="text-white bg-red-500 hover:bg-opacity-90 focus:ring-2 focus:outline-none focus:ring-red-500 font-medium rounded-full text-sm w-60 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
<script src="{{ asset('js/page/event/event-edit.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('default-modal'); // Deklarasi hanya sekali
    const nomorKursiInput = document.getElementById('nomor_kursi');
    const pangkatMemberInput = document.getElementById('pangkat_member');

    // Menampilkan modal jika ada error
    @if($errors->any())
        modal.classList.add('flex');
        modal.classList.remove('hidden');

        // Mengisi input dengan nilai dari sessionStorage jika ada
        const savedKursi = sessionStorage.getItem('nomor_kursi');
        const savedPangkat = sessionStorage.getItem('pangkat_member');

        if (savedKursi) nomorKursiInput.value = savedKursi;
        if (savedPangkat) pangkatMemberInput.value = savedPangkat;
    @endif

    // Menutup modal ketika area di luar modal diklik
    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            sessionStorage.removeItem('nomor_kursi');
            sessionStorage.removeItem('pangkat_member');
        }
    });

    // Simpan data kursi dan pangkat ke sessionStorage saat tombol diklik
    document.querySelectorAll('.btn-status').forEach(button => {
        button.addEventListener('click', function () {
            let kursi = this.getAttribute('data-kursi');
            let pangkat = this.getAttribute('data-pangkat');

            sessionStorage.setItem('nomor_kursi', kursi);
            sessionStorage.setItem('pangkat_member', pangkat);

            nomorKursiInput.value = kursi;
            pangkatMemberInput.value = pangkat;
        });
    });
});
</script>
@endsection