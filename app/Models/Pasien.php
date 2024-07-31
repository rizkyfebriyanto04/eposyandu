<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'namapasien',
        'nik',
        'jeniskelamin',
        'tanggalahir',
        'alamat',
        'beratbadan',
        'stunting',
        'imunisasi',
        'obat',

    ];
}
