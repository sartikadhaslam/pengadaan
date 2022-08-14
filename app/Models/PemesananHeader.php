<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananHeader extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_header';

    protected $fillable = [
        'no_pemesanan', 
        'tanggal_pemesanan', 
        'id_customer',
        'nama_customer',
        'alamat_customer',
        'telepon_customer',
        'fax_customer',
        'ship_to',
        'delivery_deadline',
        'delivery_terms',
        'payment_terms',
        'remark',
        'status',
        'created_at',
        'updated_at'
    ];
}
