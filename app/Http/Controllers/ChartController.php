<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ytbs1;

class ChartController extends Controller
{
    public function tegangan() {
    $datas = Ytbs1::latest()->take(10)->get()->sortBy('id');
    $teg = $datas->pluck('tegangan');
    $waktu = $datas->pluck('created_at');
    $wkt = $waktu->map(function($item){
        return $item->format('H:i:s');
    });

    return response()->json(compact('teg', 'wkt'));
    }

    public function arus() {
        $datas = Ytbs1::latest()->take(10)->get()->sortBy('id');
        $arus = $datas->pluck('arus');
        $waktu = $datas->pluck('created_at');
        $wkt = $waktu->map(function($item){
            return $item->format('H:i:s');
        });
    
        return response()->json(compact('arus', 'wkt'));
    }

        public function daya() {
            $datas = Ytbs1::latest()->take(10)->get()->sortBy('id');
            $daya = $datas->pluck('dy_aktif');
            $waktu = $datas->pluck('created_at');
            $wkt = $waktu->map(function($item){
                return $item->format('H:i:s');
            });
        
            return response()->json(compact('daya', 'wkt'));
        }

            public function energi() {
                $datas = Ytbs1::latest()->take(10)->get()->sortBy('id');
                $energi = $datas->pluck('Energi');
                $waktu = $datas->pluck('created_at');
                $wkt = $waktu->map(function($item){
                    return $item->format('H:i:s');
                });
            
                return response()->json(compact('energi', 'wkt'));
            }

    
}
