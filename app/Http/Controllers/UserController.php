<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class UserController extends Controller
{

    public function registrasi()
    {
        $title = 'E-Posyandu';
        $data = DB::table('users')
                ->get();
        $pasien = DB::table('pasien')
                ->get();
        return view('registrasi.register', compact('title','data','pasien'));
    }

    public function registrasi_aksi(Request $request)
    {

        $pasien = $request->objectpasienfk === '--Pilih--' ? null : $request->objectpasienfk;
        // return $pasien;
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pasien',
            'password' => Hash::make($request->password),
            'objectpasienfk' => $pasien,
        ]);

        $user->save();

        return redirect()->route('registrasi')->with('success', 'Akun Berhasil Di Tambahkan');
    }

    public function registrasi_aksi_login(Request $request)
    {
        // dd($request);

        $pasien = $request->objectpasienfk === '--Pilih--' ? null : $request->objectpasienfk;
        // return $guru;

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'objectpasienfk' => $pasien,
        ]);
        $user->save();

        // return redirect()->route('/')->with('success', 'Daftar Akun berhasil');
        Session::flash('success','Daftar Akun berhasil');
            return redirect('/');
    }

    public function hapusregistrasi($id){

        if($id == 1){
            return redirect()->route('registrasi')->with('error', 'Admin Tidak bisa di Hapus');
        }else{
            $user = User::find($id);
            $user->delete();
            return redirect()->route('registrasi')->with('success', 'Data Berhasil Dihapus');
        }

    }

    public function updateregistrasi(Request $request, $id)
    {
        // $request->validate([
        //     'namalengkap' => 'required',
        // ]);

        // $guru->namalengkap = $request->namalengkap;
        $guru = User::find($id);
        $guru->name = $request->name;
        $guru->email = $request->email;
        // $guru->role = $request->role;
        $guru->password = Hash::make($request->password);
        $guru->objectpasienfk = $request->objectpasienfk;
        $guru->save();

        return redirect()->route('registrasi')->with('success', 'Data Berhasil Diubah');
    }


}
