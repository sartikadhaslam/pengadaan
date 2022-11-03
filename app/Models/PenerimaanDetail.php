<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanDetail extends Model
{
    use HasFactory;

    protected $table = 'penerimaan_detail';

    protected $fillable = [
        'id_penerimaan', 
        'id_barang', 
        'nama_barang',
        'unit',
        'qty',
        'unit_price',
        'total'
    ];

    public static function delPenerimaanDetail($id)
    {
        $delPenerimaanDetailbyId = PenerimaanDetail::destroy($id);

        return $delPenerimaanDetailbyId;
    }
}
