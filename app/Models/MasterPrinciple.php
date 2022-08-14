<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPrinciple extends Model
{
    use HasFactory;

    protected $table = 'master_principle';

    protected $fillable = [
        'nama_principle', 
        'alamat', 
        'no_telp',
        'nama_pic'
    ];

    public static function getMasterPrinciple()
    {
        $getMasterPrinciple = MasterPrinciple::orderBy('nama_principle', 'asc')
        ->get();

        return $getMasterPrinciple;
    }

    public static function getMasterPrinciplebyId($id)
    {
        $getMasterPrinciplebyId = MasterPrinciple::findOrFail($id);

        return $getMasterPrinciplebyId;
    }

    public static function storeMasterPrinciple($nama_principle, $alamat, $no_telp, $nama_pic)
    {
        $storeMasterPrinciple = new MasterPrinciple();
        $storeMasterPrinciple->nama_principle = $nama_principle;
        $storeMasterPrinciple->alamat = $alamat;
        $storeMasterPrinciple->no_telp = $no_telp;
        $storeMasterPrinciple->nama_pic = $nama_pic;
        $storeMasterPrinciple->save();

        return $storeMasterPrinciple;
    }

    public static function updateMasterPrinciple($id, $nama_principle, $alamat, $no_telp, $nama_pic)
    {
        $updateMasterPrinciple = MasterPrinciple::find($id);
        $updateMasterPrinciple->nama_principle = $nama_principle;
        $updateMasterPrinciple->alamat = $alamat;
        $updateMasterPrinciple->no_telp = $no_telp;
        $updateMasterPrinciple->nama_pic = $nama_pic;
        $updateMasterPrinciple->save();

        return $updateMasterPrinciple;
    }

    public static function delMasterPrinciplebyId($id)
    {
        $delMasterPrinciplebyId = MasterPrinciple::destroy($id);

        return $delMasterPrinciplebyId;
    }
}
