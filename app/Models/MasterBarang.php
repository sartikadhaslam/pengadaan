<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barang';

    protected $fillable = [
        'nama_barang', 
        'unit',
        'harga', 
    ];

    public static function getMasterBarang()
    {
        $getMasterBarang = MasterBarang::orderBy('nama_barang', 'asc')
        ->get();

        return $getMasterBarang;
    }

    public static function getMasterBarangbyId($id)
    {
        $getMasterBarangbyId = MasterBarang::findOrFail($id);

        return $getMasterBarangbyId;
    }

    public static function storeMasterBarang($nama_barang, $unit, $harga)
    {
        $storeMasterBarang = new MasterBarang();
        $storeMasterBarang->nama_barang = $nama_barang;
        $storeMasterBarang->unit = $unit;
        $storeMasterBarang->harga = $harga;
        $storeMasterBarang->save();

        return $storeMasterBarang;
    }

    public static function updateMasterBarang($id, $nama_barang, $unit, $harga)
    {
        $updateMasterBarang = MasterBarang::find($id);
        $updateMasterBarang->nama_barang = $nama_barang;
        $updateMasterBarang->unit = $unit;
        $updateMasterBarang->harga = $harga;
        $updateMasterBarang->save();

        return $updateMasterBarang;
    }

    public static function delMasterBarangbyId($id)
    {
        $delMasterBarangbyId = MasterBarang::destroy($id);

        return $delMasterBarangbyId;
    }
}
