<?php

namespace App\Http\Controllers;

use Carbon;
// use PDF;
use Session;
use Illuminate\Http\Request;
use App\Models\Ytbs1;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
	public function semua() {
		$data = Ytbs1::orderBy('created_at', 'desc')->get();
    	$hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('MM/DD/YYYY');
        $bulan_depan = $hari_ini->add(1, 'month');
        $bulan_depan2 = $bulan_depan->isoFormat('MM/DD/YYYY');

    	return view('halaman_laporan.halaman_semua', compact('data', 'hari_ini2', 'bulan_depan2'));
	}

	public function saring (Request $req)
    {
		if($req->check_semua == 1){
    		$transaksis = Ytbs1::select("*")->get();
	    	return view('halaman_laporan.sort_halaman_laporan_daya', compact('transaksis'));
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Ytbs1::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	return view('halaman_laporan.sort_halaman_laporan_daya', compact('transaksis'));
    	}
    }

	public function unduh(Request $req)
    {
    	if($req->check_semua == 1){
    		$transaksis = Ytbs1::get();
	    	$tanggal = "Semua Daya";
	    	$start_date2 = "";
	    	$end_date2 = "";

	    	$pdf = \PDF::loadView('halaman_laporan.pdf_laporan_daya', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
		}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Ytbs1::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	$tanggal = "";

	    	$pdf = \PDF::loadview('halaman_laporan.pdf_laporan_daya', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
    	}
    }

}
