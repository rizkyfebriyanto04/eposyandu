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
        ->select('id', 'namapasien', 'nik', 'jeniskelamin', 'tanggalahir', 'alamat', 'beratbadan','tinggibadan', 'stunting', 'imunisasi', 'obat',
                 DB::raw('TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()) as tahun'),
                 DB::raw('FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)) as bulan'),
                 DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()), " tahun ", FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)), " bulan") as umur'))
        ->get();

        return view('pasien.index',compact('title','data'));
    }

    public function pasien_aksi(Request $request)
    {
        if (!str_contains(strtolower($request->alamat), 'margahayu')) {
            return redirect()->back()->withInput()->with('error', 'Bukan Warga Margahayu');
        }
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
        ->select('id', 'namapasien', 'nik', 'jeniskelamin', 'tanggalahir', 'alamat', 'beratbadan','tinggibadan', 'stunting', 'imunisasi', 'obat',
                 DB::raw('TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()) as tahun'),
                 DB::raw('FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)) as bulan'),
                 DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()), " tahun ", FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)), " bulan") as umur'))
        ->get();

        return view('penimbangan.index',compact('title','data'));
    }

    public function updatepenimbangan(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        $beratBadan = $request->beratbadan;
        $tinggiBadan = $request->tinggibadan;

        $pasien->beratbadan = $beratBadan;
        $pasien->tinggibadan = $tinggiBadan;
        $pasien->save();

        $tanggalahir = $pasien->tanggalahir;
        $umurTahun = date_diff(date_create($tanggalahir), date_create('now'))->y;
        $jenisKelamin = $pasien->jeniskelamin;

        $stuntingStatus = '';
        if ($umurTahun == 1) {
            if ($jenisKelamin == 'laki-laki') {
                if ($beratBadan >= 7 && $beratBadan <= 12 && $tinggiBadan >= 70 && $tinggiBadan <= 78) {
                    $stuntingStatus = 'Anak/Bayi normal';
                }else{
                    $stuntingStatus = 'Anak/Bayi Terkena Stunting';
                }
            } elseif ($jenisKelamin == 'perempuan') {
                if ($beratBadan >= 7 && $beratBadan <= 11 && $tinggiBadan >= 70 && $tinggiBadan <= 78) {
                    $stuntingStatus = 'Anak/Bayi normal';
                }else{
                    $stuntingStatus = 'Anak/Bayi Terkena Stunting';
                }
            }
        } elseif ($umurTahun == 2) {
            if ($jenisKelamin == 'laki-laki') {
                if ($beratBadan >= 9 && $beratBadan <= 15 && $tinggiBadan >= 80 && $tinggiBadan <= 92) {
                    $stuntingStatus = 'Anak/Bayi normal';
                }else{
                    $stuntingStatus = 'Anak/Bayi Terkena Stunting';
                }
            } elseif ($jenisKelamin == 'perempuan') {
                if ($beratBadan >= 9 && $beratBadan <= 14 && $tinggiBadan >= 80 && $tinggiBadan <= 92) {
                    $stuntingStatus = 'Anak/Bayi normal';
                }else{
                    $stuntingStatus = 'Anak/Bayi Terkena Stunting';
                }
            }
        } elseif ($umurTahun > 3) {
            if ($jenisKelamin == 'laki-laki') {
                if ($beratBadan >= 9 && $beratBadan <= 15 && $tinggiBadan >= 82 && $tinggiBadan <= 95) {
                    $stuntingStatus = 'Anak/Bayi normal';
                }else{
                    $stuntingStatus = 'Anak/Bayi Terkena Stunting';
                }
            } elseif ($jenisKelamin == 'perempuan') {
                if ($beratBadan >= 9 && $beratBadan <= 14 && $tinggiBadan >= 82 && $tinggiBadan <= 95) {
                    $stuntingStatus = 'Anak/Bayi normal';
                }else{
                    $stuntingStatus = 'Anak/Bayi Terkena Stunting';
                }
            }
        }
        // if ($umurTahun == 1) {
        //     if ($jenisKelamin == 'laki-laki') {
        //         if ($tinggiBadan < 71.0) {
        //             return 'etst';
        //             $stuntingStatus = 'Bayi terkena stunting';
        //         } elseif ($tinggiBadan >= 71.0 && $tinggiBadan <= 78.1 && $beratBadan >= 7.7 && $beratBadan <= 10.8) {
        //             return 'etstasdas';
        //             $stuntingStatus = 'Bayi normal';
        //         }
        //     } elseif ($jenisKelamin == 'perempuan') {
        //         if ($tinggiBadan < 68.9) {
        //             $stuntingStatus = 'Bayi terkena stunting';
        //         } elseif ($tinggiBadan >= 68.9 && $tinggiBadan <= 76.6 && $beratBadan >= 7.0 && $beratBadan <= 10.1) {
        //             $stuntingStatus = 'Bayi normal';
        //         }
        //     }
        // } elseif ($umurTahun == 2) {
        //     if ($jenisKelamin == 'laki-laki') {
        //         if ($tinggiBadan < 81.7) {
        //             $stuntingStatus = 'Anak terkena stunting';
        //         } elseif ($tinggiBadan >= 81.7 && $tinggiBadan <= 90.9 && $beratBadan >= 9.7 && $beratBadan <= 13.6) {
        //             $stuntingStatus = 'Anak normal';
        //         }
        //     } elseif ($jenisKelamin == 'perempuan') {
        //         if ($tinggiBadan < 80.0) {
        //             $stuntingStatus = 'Anak terkena stunting';
        //         } elseif ($tinggiBadan >= 80.0 && $tinggiBadan <= 89.6 && $beratBadan >= 9.0 && $beratBadan <= 13.0) {
        //             $stuntingStatus = 'Anak normal';
        //         }
        //     }
        // } elseif ($umurTahun == 3) {
        //     if ($jenisKelamin == 'laki-laki') {
        //         if ($tinggiBadan < 82.0) {
        //             $stuntingStatus = 'Anak terkena stunting';
        //         } elseif ($tinggiBadan >= 82.0 && $tinggiBadan <= 95.0 && $beratBadan >= 11.3 && $beratBadan <= 18.3) {
        //             $stuntingStatus = 'Anak normal';
        //         }
        //     } elseif ($jenisKelamin == 'perempuan') {
        //         if ($tinggiBadan < 82.0) {
        //             $stuntingStatus = 'Anak terkena stunting';
        //         } elseif ($tinggiBadan >= 82.0 && $tinggiBadan <= 95.0 && $beratBadan >= 10.8 && $beratBadan <= 18.1) {
        //             $stuntingStatus = 'Anak normal';
        //         }
        //     }
        // }

        $pasien->stunting = $stuntingStatus;
        $pasien->save();

        return redirect()->route('penimbangan')->with('success', 'Data Berhasil Diubah');
    }

    public function imunisasi(){
        $title = 'Pasien';

        $data = DB::table('pasien')
        ->select('id', 'namapasien', 'nik', 'jeniskelamin', 'tanggalahir', 'alamat', 'beratbadan','tinggibadan', 'stunting', 'imunisasi', 'obat',
                 DB::raw('TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()) as tahun'),
                 DB::raw('FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)) as bulan'),
                 DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()), " tahun ", FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)), " bulan") as umur'))
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
        ->select('id', 'namapasien', 'nik', 'jeniskelamin', 'tanggalahir', 'alamat', 'beratbadan','tinggibadan', 'stunting', 'imunisasi', 'obat',
                 DB::raw('TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()) as tahun'),
                 DB::raw('FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)) as bulan'),
                 DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()), " tahun ", FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)), " bulan") as umur'))
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
        ->select('id', 'namapasien', 'nik', 'jeniskelamin', 'tanggalahir', 'alamat', 'beratbadan','tinggibadan', 'stunting', 'imunisasi', 'obat',
                 DB::raw('TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()) as tahun'),
                 DB::raw('FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)) as bulan'),
                 DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()), " tahun ", FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)), " bulan") as umur'))
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
        ->select('id', 'namapasien', 'nik', 'jeniskelamin', 'tanggalahir', 'alamat', 'beratbadan','tinggibadan', 'stunting', 'imunisasi', 'obat',
                 DB::raw('TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()) as tahun'),
                 DB::raw('FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)) as bulan'),
                 DB::raw('CONCAT(TIMESTAMPDIFF(YEAR, tanggalahir, CURDATE()), " tahun ", FLOOR(MOD(PERIOD_DIFF(DATE_FORMAT(CURDATE(), "%Y%m"), DATE_FORMAT(tanggalahir, "%Y%m")), 12)), " bulan") as umur'))
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
            return redirect()->route('tampilpasien')->with('error', 'Pasien tidak Terdaftar');
        }
    }


    public function hapuspenimbangan($id){
        $user = Pasien::find($id);
        $user->beratbadan = null;
        $user->tinggibadan = null;
        $user->save();

        return redirect()->route('penimbangan')->with('success', 'Data Berhasil Dihapus');
    }

    public function hapusimunisasi($id){
        $user = Pasien::find($id);
        $user->imunisasi = null;
        $user->save();

        return redirect()->route('imunisasi')->with('success', 'Data Berhasil Dihapus');
    }

    public function hapusstunting($id){
        $user = Pasien::find($id);
        $user->stunting = null;
        $user->save();

        return redirect()->route('imunisasi')->with('success', 'Data Berhasil Dihapus');
    }

    public function hapusobat($id){
        $user = Pasien::find($id);
        $user->obat = null;
        $user->save();

        return redirect()->route('obat')->with('success', 'Data Berhasil Dihapus');
    }


}
