<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class KontrolController extends Controller
{
    public function kontrol(Request $request) {
        $user = Device::find($request->id);
        // dd($user);
        $user->panel = $request->panel;
        $user->save();

        
        return response()->json(['success'=>'User status change successfully.']);
       
    }
}
