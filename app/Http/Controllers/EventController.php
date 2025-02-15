<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function event(){
        $pageConfigs = [
            'title' => 'Event',
        ];

        $events = Event::all();

        return view('pages.event.event', ['pageConfigs'=>$pageConfigs, 'events'=>$events]);
    }

    public function add(){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Event',
            'formTarget' => 'event-created',
            'pageType' => 'add',    
        ];
        return view('pages.event.event-add', ['pageConfigs'=>$pageConfigs]);
    }

    public function created(Request $request){
        $request->validate([
            'nama_event' => 'required',
            'tanggal_event' => 'required',
            'deskripsi' => 'required',
        ],[
            'nama_event.required' => 'Nama Event wajib diisi',
            'tanggal_event.required' => 'Tanggal Event wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
        ]);

        try{
            $kd_event = Event::orderBy('kd_event', 'desc')->first();
            $ID = 'EV-' . date('y') . date('m') . str_pad( ($kd_event ? intval(substr($kd_event->kd_event, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            Event::create([
                'kd_event' => $ID,
                'nama_event' => $request->nama_event,
                'tanggal_event' => $request->tanggal_event,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('event-page')->with('success', 'Event berhasil ditambahkan');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server. Silakan coba lagi nanti.');
        }
    }

    public function udangFull($eventId){
        $event = Event::findOrFail($eventId);
        $members = Member::pluck('kd_member');

        $nomorKursi = 1;
        $data = [];

        foreach ($members as $memberId) {
            $data[$memberId] = ['nomor_kursi' => $nomorKursi];
            $nomorKursi++;
        }

        $event->members()->sync($data);

        return redirect()->route('event-page')->with('success', 'Undangan berhasil dikirim');
    }

    public function detail($eventId){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Detail Event',
        ];
        $event = Event::with(['members' => function($query) {
            $query->orderBy('id', 'asc');
        }])->findOrFail($eventId);
        
        return view('pages.event.event-detail', ['pageConfigs'=>$pageConfigs, 'events' => $event]);
    }

    public function updateNomorKursi(Request $request){
        $request->validate([
            'nomor_kursi' => 'required|numeric',
        ],[
            'nomor_kursi.required' => 'Nomor Kursi wajib diisi',
            'nomor_kursi.numeric' => 'Nomor Kursi harus berupa angka',
        ]);

        try{

            $event = Event::where('kd_event', $request->event_id)->first();
            $member = $event->members()->where('member.kd_member', $request->kd_member)->first();
            $kursi = $event->members()->wherePivot('nomor_kursi', $request->nomor_kursi)->first();

            if ($kursi) {
                $setNomorKursi = $member->pivot->nomor_kursi;

                $event->members()->updateExistingPivot($member->kd_member, ['nomor_kursi' => $request->nomor_kursi]);
                $event->members()->updateExistingPivot($kursi->kd_member, ['nomor_kursi' => $setNomorKursi]);
            } else {
                $event->members()->updateExistingPivot($member->kd_member, ['nomor_kursi' => $request->nomor_kursi]);
            }

            return redirect()->back()->with('success', 'Nomor Kursi berhasil diubah');

            
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server. Silakan coba lagi nanti.');    
        }
    }
}
