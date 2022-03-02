<?php

namespace App\Http\Controllers;

// use PDF;
use Carbon;
use App\User;
use App\Transaksi;
use App\Suhu;
use Session;
use App\Arduino;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class HalLaporanController extends Controller
{

	public function halamanLaporanPf() {
		// $pf_hasil = Arduino::get();
		$pf_hasil = Arduino::orderBy('created_at', 'desc')->get();
    	$hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('MM/DD/YYYY');
        $bulan_depan = $hari_ini->add(1, 'month');
        $bulan_depan2 = $bulan_depan->isoFormat('MM/DD/YYYY');

    	return view('halaman_laporan.halaman_laporan_pf', compact('pf_hasil', 'hari_ini2', 'bulan_depan2'));
	}

	public function filterLaporanpf (Request $req)
    {
		if($req->check_semua == 1){
    		$transaksis = Arduino::select("*")->get();
	    	return view('halaman_laporan.sort_halaman_laporan_pf', compact('transaksis'));
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	return view('halaman_laporan.sort_halaman_laporan_pf', compact('transaksis'));
    	}
    }

	public function pdfLaporanpf(Request $req)
    {
    	if($req->check_semua == 1){
    		$transaksis = Arduino::get();
	    	$tanggal = "Semua Power Factor";
	    	$start_date2 = "";
	    	$end_date2 = "";

	    	$pdf = PDF::loadView('halaman_laporan.pdf_laporan_pf', [
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
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	$tanggal = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_pf', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
    	}
    }

	public function halamanLaporanDaya() {
		$pf_hasil = Arduino::orderBy('created_at', 'desc')->get();
    	$hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('MM/DD/YYYY');
        $bulan_depan = $hari_ini->add(1, 'month');
        $bulan_depan2 = $bulan_depan->isoFormat('MM/DD/YYYY');

    	return view('halaman_laporan.halaman_laporan_daya', compact('pf_hasil', 'hari_ini2', 'bulan_depan2'));
	}

	public function filterLaporandaya (Request $req)
    {
		if($req->check_semua == 1){
    		$transaksis = Arduino::select("*")->get();
	    	return view('halaman_laporan.sort_halaman_laporan_daya', compact('transaksis'));
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	return view('halaman_laporan.sort_halaman_laporan_daya', compact('transaksis'));
    	}
    }

	public function pdfLaporandaya(Request $req)
    {
    	if($req->check_semua == 1){
    		$transaksis = Arduino::get();
	    	$tanggal = "Semua Daya";
	    	$start_date2 = "";
	    	$end_date2 = "";

	    	$pdf = PDF::loadView('halaman_laporan.pdf_laporan_daya', [
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
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	$tanggal = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_daya', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
    	}
    }


	public function halamanLaporanenergi() {
		$energi_hasil = Arduino::orderBy('created_at', 'desc')->get();
    	$hari_ini = Carbon\Carbon::now();
        $hari_ini2 = $hari_ini->isoFormat('MM/DD/YYYY');
        $bulan_depan = $hari_ini->add(1, 'month');
        $bulan_depan2 = $bulan_depan->isoFormat('MM/DD/YYYY');

    	return view('halaman_laporan.halaman_laporan_energi', compact('energi_hasil', 'hari_ini2', 'bulan_depan2'));
	}

	public function filterLaporanenergi (Request $req)
    { 
		if($req->check_semua == 1){
    		$transaksis = Arduino::select("*")->get();
	    	return view('halaman_laporan.sort_halaman_laporan_energi', compact('transaksis'));
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	return view('halaman_laporan.sort_halaman_laporan_energi', compact('transaksis'));
    	}
    }

	public function pdfLaporanenergi(Request $req)
    {
    	if($req->check_semua == 1){
    		$transaksis = Arduino::get();
	    	$tanggal = "Semua Daya";
	    	$start_date2 = "";
	    	$end_date2 = "";

	    	$pdf = PDF::loadView('halaman_laporan.pdf_laporan_energi', [
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
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->get();
	    	$tanggal = "";

	    	$pdf = PDF::loadview('halaman_laporan.pdf_laporan_energi', [
	            'transaksis' => $transaksis,
	            'tanggal' => $tanggal,
	            'start_date2' => $start_date2,
	            'end_date2' => $end_date2
	        ]);
	        return $pdf->stream();
    	}
    }

	public function halamanHapus() {
		
		
		return view('halaman_laporan.halaman_hapus_laporan');
	}

	public function filterHapusEnergi (Request $req)
    { 
		if($req->check_semua == 1){
    		$transaksis = Arduino::select("*")->get();
	    	// return view('halaman_laporan.sort_halaman_hapus_energi', compact('transaksis'));
			dd($transaksis);
    	}else{
    		$start_date = $req->start_date;
    		$end_date = $req->end_date;
    		$start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];
    		$end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];
    		$transaksis = Arduino::select("*")->whereBetween('created_at', array($start_date2, $end_date2))->delete();
	    	// return view('halaman_laporan.halaman_laporan_energi');
			Session::flash('hapuss', 'Data Laporan berhasil dihapuss.');
			return redirect('hapus_halaman');
			// dd($transaksis);
    	}
    }



}
