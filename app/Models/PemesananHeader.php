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
        'alamat_customer',
        'telepon_customer',
        'fax_customer',
        'ship_to',
        'delivery_deadline',
        'payment_terms',
        'remark',
        'file',
        'status'

    ];

    public static function getPemesananHeader()
    {
        $getPemesananHeader = PemesananHeader::orderBy('created_at', 'asc')
        ->get();

        return $getPemesananHeader;
    }

    public static function delPemesananHeader($id)
    {
        $delPemesananHeaderbyId = PemesananHeader::destroy($id);

        return $delPemesananHeaderbyId;
    }
}