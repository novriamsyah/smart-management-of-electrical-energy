<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Device;

class DeviceControlle extends Controller
{
    // public function halamankontrol() {
    //     $kontrol = Device::get();
    //     return view('halaman_kontrol.halaman_kontrol', compact('kontrol'));
    // }
    public function kontrol(Request $request) {
        $user = Device::find($request->id);
        dd($user);
        $user->panel = $request->panel;
        $user->save();

        
        return response()->json(['success'=>'User status change successfully.']);
        // return response()->json(['success'=>$user]);
        // return json_encode(array('user'=>$user));
        // return redirect('kontrol.index');
    }
    // public function tabel_kontrol() {
    //     $status_panel = Device::get();

    //     $wkt = $status_panel->pluck('updated_at');
    //     $waktu = $wkt->map(function($item){
            
    //         return $item->diffForHumans();
    //     });


    //     return json_encode(array('status_panel'=>$status_panel, 'waktu'=>$waktu));

    // }
    
}
