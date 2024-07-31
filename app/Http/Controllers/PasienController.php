<?php

namespace App\Http\Controllers;

use App\Models\Pasien;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Whoops\Run;

class PasienController extends Controller
{
    public function pasien(){
        $title = 'Pasien';

        $data = DB::table('pasien')
                ->get();

        return view('pasien.index',compact('title','data'));
    }

    public function pasien_aksi(Request $request)
    {
        $pasien = new Pasien([
            'namapasien' => $request->namapasien,
            'nik' => $request->nik,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggalahir' => $request->tanggalahir,
            'alamat' => $request->alamat,
        ]);

        $pasien->save();

        return redirect()->route('pasien')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function editpasien($id)
    {
        $pasien = Pasien::find($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function updatepasien(Request $request, $id)
    {

        $pasien = Pasien::find($id);
        $pasien->namapasien = $request->namapasien;
        $pasien->nik = $request->nik;
        $pasien->jeniskelamin = $request->jeniskelamin;
        $pasien->tanggalahir = $request->tanggalahir;
        $pasien->alamat = $request->alamat;
        $pasien->beratbadan = $request->beratbadan;
        $pasien->stunting = $request->stunting;
        $pasien->imunisasi = $request->imunisasi;
        $pasien->obat = $request->obat;
        $pasien->save();

        return redirect()->route('pasien')->with('success', 'Data Berhasil Diubah');
    }

    public function hapuspasien($id){
        $pasien = Pasien::find($id);
        $pasien->delete();

        return redirect()->route('pasien')->with('success', 'Data Berhasil Dihapus');
    }

    public function penimbangan(){
        $title = 'Pasien';

        $data = DB::table('pasien')
                ->get();

        return view('penimbangan.index',compact('title','data'));
    }

    public function updatepenimbangan(Request $request, $id)
    {

        $pasien = Pasien::find($id);
        $pasien->beratbadan = $request->beratbadan;
        $pasien->save();

        return redirect()->route('penimbangan')->with('success', 'Data Berhasil Diubah');
    }

    public function imunisasi(){
        $title = 'Pasien';

        $data = DB::table('pasien')
                ->get();

        return view('imunisasi.index',compact('title','data'));
    }

    public function updateimunisasi(Request $request, $id)
    {

        $pasien = Pasien::find($id);
        $pasien->imunisasi = $request->imunisasi;
        $pasien->save();

        return redirect()->route('imunisasi')->with('success', 'Data Berhasil Diubah');
    }

    public function stunting(){
        $title = 'Pasien';

        $data = DB::table('pasien')
                ->get();

        return view('stunting.index',compact('title','data'));
    }

    public function updatestunting(Request $request, $id)
    {

        $pasien = Pasien::find($id);
        $pasien->stunting = $request->stunting;
        $pasien->save();

        return redirect()->route('stunting')->with('success', 'Data Berhasil Diubah');
    }

    public function obat(){
        $title = 'Pasien';

        $data = DB::table('pasien')
                ->get();

        return view('obat.index',compact('title','data'));
    }

    public function updateobat(Request $request, $id)
    {

        $pasien = Pasien::find($id);
        $pasien->obat = $request->obat;
        $pasien->save();

        return redirect()->route('obat')->with('success', 'Data Berhasil Diubah');
    }

    public function tampilpasien(){
        $title = 'Pasien';
        $pasien = DB::table('pasien')
        ->get();
        return view('pasien.caripasien', compact('pasien','title'));
    }

    public function caripasien(Request $request){
        $search = $request->input('caripasien');

        $pasien = DB::table('pasien')
            ->where('namapasien', 'like', '%' . $search . '%')
            ->get();
        if ($pasien->count() == 1) {
            return view('pasien.detailpasien', compact('pasien'))->with('success', 'Data Siswa Terdaftar');
        } else {
            return redirect('caripasien')->with('error', 'Data tidak Terdaftar');
        }
    }


}
