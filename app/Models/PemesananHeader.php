<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananHeader extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_header';

    protected $fillable = [
        'id_customer', 
        'tanggal', 
        'no_pemesanan',
        'term_condition',
        'nama_pic',
        'jabatan_pic',
        'status'
    ];
}
