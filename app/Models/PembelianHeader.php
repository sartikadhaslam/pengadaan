<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianHeader extends Model
{
    use HasFactory;

    protected $table = 'pembelian_header';

    protected $fillable = [
        'no_pembelian', 
        'tanggal_pembelian', 
        'id_principle',
        'alamat_principle',
        'telepon_principle',
        'fax_principle',
        'term_condition',
        'status'
    ];

    public static function delPembelianHeader($id)
    {
        $delPembelianHeaderbyId = PembelianHeader::destroy($id);

        return $delPembelianHeaderbyId;
    }
}
