<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $customer = Customer::paginate(4);
      return view('partial.invoice', compact('customer'));
    }

    public function customertb(){
      return DataTables::of(Customer::query())
      ->addColumn('Jenis Pakaian', function($datatb) {
          return DB::table('jenis_pakaian')->where('id','=',$datatb->id_jenispakaian)->first()->jenis_pakaian;
      })
      ->addColumn('Pengharum', function($datatb) {
          return DB::table('pengharum')->where('id','=',$datatb->id_pengharum)->first()->nama_pengharum;
      })
    ->make(true);
   }
}
