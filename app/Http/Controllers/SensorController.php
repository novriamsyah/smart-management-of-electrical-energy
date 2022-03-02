<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\Ytbs1Projek;


class SensorController extends Controller
{
    public function masuk($tegangan, $arus, $dy_aktif, $energi) {
        $data = DB::table('ytbs1');
        $tgl = Carbon::now();
        $tgl1 = Carbon::now();

        $data->insert([
            'tegangan' => $tegangan,
            'arus' => $arus,
            'dy_aktif' => $dy_aktif,
            'Energi' => $energi,
            'created_at' => $tgl,
            'updated_at' => $tgl1
        ]);

        return event(new Ytbs1Projek($tegangan, $arus, $dy_aktif, $energi));
    }
}
