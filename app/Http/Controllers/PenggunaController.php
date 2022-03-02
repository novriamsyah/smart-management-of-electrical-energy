<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PenggunaController extends Controller
{
    // Membuka Halaman Pengguna
    public function halamanPengguna()
    {
    	$penggunas = User::all();


        $max = User::max('kd_pengguna');
         $check_maks = User::select('users.kd_pengguna')
         ->count();
         if($check_maks == null){
             $max_code = "U0001";
         }else{
             $max_code = $max[1].$max[2].$max[3].$max[4];
             $max_code++;
             if($max_code <= 9){
                 $max_code = "U000".$max_code;
             }elseif ($max_code <= 99) {
                 $max_code = "U00".$max_code;
             }elseif ($max_code <= 999) {
                 $max_code = "U0".$max_code;
             }elseif ($max_code <= 9999) {
                 $max_code = "U".$max_code;
             }
         }
        
    	return view('halaman_pengguna.halaman_pengguna', compact('penggunas', 'max_code'));
    }

     // Membuka Halaman Tambah Pengguna
     public function tambahPengguna()
     {
         // $outlets = Outlet::all();
         $max = User::max('kd_pengguna');
         $check_maks = User::select('users.kd_pengguna')
         ->count();
         if($check_maks == null){
             $max_code = "U0001";
         }else{
             $max_code = $max[1].$max[2].$max[3].$max[4];
             $max_code++;
             if($max_code <= 9){
                 $max_code = "U000".$max_code;
             }elseif ($max_code <= 99) {
                 $max_code = "U00".$max_code;
             }elseif ($max_code <= 999) {
                 $max_code = "U0".$max_code;
             }elseif ($max_code <= 9999) {
                 $max_code = "U".$max_code;
             }
         }
         return view('halaman_pengguna.halaman_pengguna', compact('max_code'));
     }
 
     // Menyimpan Pengguna Baru
     public function simpanPengguna(Request $req)
     {
         $cek_username = User::where('username', '=', $req->username)
         ->count();
         if($cek_username == 1)
         {
             Session::flash('tidak_tersimpan', 'Maaf username telah digunakan');
             return redirect('/kelola_pengguna');
         }else{
             if($req->avatar != "")
             {
                 $penggunas = new User;
                 $penggunas->kd_pengguna = $req->kd_pengguna;
                 $penggunas->role = $req->role;
                 $penggunas->username = $req->username;
                 $penggunas->email = $req->email;
                 $penggunas->password = Hash::make($req->password);
                 $penggunas->remember_token = Str::random(60);
                 $penggunas->save();
                 Session::flash('tersimpan', 'Pengguna baru berhasil ditambahkan');
                 return redirect('/kelola_pengguna');
             }else{
                 $penggunas = new User;
                 $penggunas->kd_pengguna = $req->kd_pengguna;
                 $penggunas->role = $req->role;
                 $penggunas->username = $req->username;
                 $penggunas->email = $req->email;
                 $penggunas->password = Hash::make($req->password);
                 $penggunas->remember_token = Str::random(60);
                 $penggunas->save();
                 Session::flash('tersimpan', 'Pengguna baru berhasil ditambahkan');
                 return redirect('/kelola_pengguna');
             }
         }
 
     }

     // Menghapus Pengguna
    public function hapusPengguna($id)
    {
    	$penggunas = User::find($id);
    	$penggunas->delete();
    	Session::flash('terhapus', 'Pengguna berhasil dihapus');
		return redirect('/kelola_pengguna');
    }

}
