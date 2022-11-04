<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanDetail extends Model
{
    use HasFactory;
    
    protected $table = 'pengiriman_detail';

    protected $fillable = [
        'id_pengiriman', 
        'id_barang', 
        'nama_barang',
        'unit',
        'qty',
        'unit_price',
        'total'
    ];

    public static function delPengirimanDetail($id)
    {
        $delPengirimanDetailbyId = PengirimanDetail::destroy($id);

        return $delPengirimanDetailbyId;
    }
}
