<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanHeader extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_header';

    protected $fillable = [
        'no_pemesanan', 
        'tanggal', 
        'id_customer',
        'no_surat_jalan',
        'no_invoice',
        'delivery_to',
        'payment_terms',
        'gross_weight',
        'dimensi',
        'status',
    ];

    public static function delPengirimanHeader($id)
    {
        $delPengirimanHeaderbyId = PengirimanHeader::destroy($id);

        return $delPengirimanHeaderbyId;
    }
}
