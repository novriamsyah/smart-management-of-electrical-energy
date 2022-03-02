<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ytbs1;
use Illuminate\Support\Facades\DB;
use App\Models\Device;

class DashboardController extends Controller
{
    public function index() {
        $data = DB::table('ytbs1')->orderBy('id', 'desc')->first();
        $kontrol = Device::get();
        return view('halaman_utama', compact('data', 'kontrol'));
    }

    public function arus() {
        $data = DB::table('ytbs1')->orderBy('id', 'desc')->first();
        $kontrol = Device::get();
        return view('halaman_arus', compact('data', 'kontrol'));
    }

    public function daya() {
        $data = DB::table('ytbs1')->orderBy('id', 'desc')->first();
        $kontrol = Device::get();
        return view('halaman_daya', compact('data', 'kontrol'));
    }

    public function energi() {
        $data = DB::table('ytbs1')->orderBy('id', 'desc')->first();
        $kontrol = Device::get();
        return view('halaman_energi', compact('data', 'kontrol'));
    }
    
}
