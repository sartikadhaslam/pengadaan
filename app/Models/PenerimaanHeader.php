<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanHeader extends Model
{
    use HasFactory;

    protected $table = 'penerimaan_header';

    protected $fillable = [
        'no_pembelian', 
        'tanggal_penerimaan', 
        'id_principle',
        'surat_tagihan',
        'packing_list',
        'nama_pengirim',
        'hp_pengirim',
        'status',
    ];

    public static function delPenerimaanHeader($id)
    {
        $delPenerimaanHeaderbyId = PenerimaanHeader::destroy($id);

        return $delPenerimaanHeaderbyId;
    }
}
