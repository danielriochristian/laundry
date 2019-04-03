<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\JenisPakaian;
use App\Pengharum;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
        return view('partial.order');
    }

    public function postorder(Request $request)
    {

      $jenis = $request->jenis;
        if($jenis == 1){
          $jenis = 9000;
        }
        else if($jenis == 2){
          $jenis = 18000;
        }
        else{
          $jenis = 10000;
        }
      $pengharum = $request->pengharum;
        if($pengharum == 1){
          $pengharum = 1000;
        }
        else if($pengharum == 2){
          $pengharum = 2000;
        }
        else{
          $pengharum = 3000;
        }
      $berat = $request->berat;
      $total = ($berat * $jenis) + $pengharum;
      $datenow = date('Y-m-d H:i:s');
      $date = date('Y-m-d H:i:s', strtotime($datenow. ' + 2 days'));
      // var_dump($jenis,$pengharum,$berat,$total);die();
      $c = new Customer;
      $c->nama = $request->nama;
      $c->hp = $request->hp;
      $c->alamat = $request->alamat;
      $c->berat = $request->berat;
      $c->id_jenispakaian = $request->jenis;
      $c->id_pengharum = $request->pengharum;
      $c->total = $total;
      $c->tgl_terima = date('Y-m-d H:i:s');
      $c->tgl_selesai = $date;
      // var_dump($c);die();
      $c->save();
      return redirect('/order');
    }
}
