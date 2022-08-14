<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_detail';

    protected $fillable = [
        'id_pemesanan', 
        'id_barang', 
        'nama_barang',
        'unit',
        'qty',
        'unit_price',
        'total'
    ];

}
