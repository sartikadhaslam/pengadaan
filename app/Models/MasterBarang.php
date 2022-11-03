<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang', 
        'unit',
        'harga_beli',
        'harga_jual' 
    ];

    public static function getMasterBarang()
    {
        $getMasterBarang = MasterBarang::orderBy('nama_barang', 'asc')
        ->paginate(5);

        return $getMasterBarang;
    }

    public static function getMasterBarangbyId($id)
    {
        $getMasterBarangbyId = MasterBarang::findOrFail($id);

        return $getMasterBarangbyId;
    }

    public static function storeMasterBarang($kode_barang, $nama_barang, $unit, $harga_beli, $harga_jual)
    {
        $storeMasterBarang = new MasterBarang();
        $storeMasterBarang->kode_barang = $kode_barang;
        $storeMasterBarang->nama_barang = $nama_barang;
        $storeMasterBarang->unit        = $unit;
        $storeMasterBarang->harga_beli  = $harga_beli;
        $storeMasterBarang->harga_jual  = $harga_jual;
        $storeMasterBarang->save();

        return $storeMasterBarang;
    }

    public static function updateMasterBarang($id, $kode_barang, $nama_barang, $unit, $harga_beli, $harga_jual)
    {
        $updateMasterBarang = MasterBarang::find($id);
        $updateMasterBarang->kode_barang = $kode_barang;
        $updateMasterBarang->nama_barang = $nama_barang;
        $updateMasterBarang->unit        = $unit;
        $updateMasterBarang->harga_beli  = $harga_beli;
        $updateMasterBarang->harga_jual  = $harga_jual;
        $updateMasterBarang->save();

        return $updateMasterBarang;
    }

    public static function delMasterBarangbyId($id)
    {
        $delMasterBarangbyId = MasterBarang::destroy($id);

        return $delMasterBarangbyId;
    }
}
