<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(){
        $title = 'Home';

        $semuapasien = DB::table('pasien')->count();

        $pasienlk = DB::table('pasien')->where('jeniskelamin','=','laki-laki')->count();
        $pasienpr = DB::table('pasien')->where('jeniskelamin','=','perempuan')->count();


        return view('home',compact('title','semuapasien','pasienlk','pasienpr'));
    }
}
