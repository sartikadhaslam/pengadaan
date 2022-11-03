<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPrinciple extends Model
{
    use HasFactory;

    protected $table = 'master_principle';

    protected $fillable = [
        'kode_principle',
        'nama_principle', 
        'alamat', 
        'email',
        'no_telp',
        'fax',
        'nama_pic',
        'jabatan_pic',
    ];

    public static function getMasterPrinciple()
    {
        $getMasterPrinciple = MasterPrinciple::orderBy('nama_principle', 'asc')
        ->paginate(5);

        return $getMasterPrinciple;
    }

    public static function getMasterPrinciplebyId($id)
    {
        $getMasterPrinciplebyId = MasterPrinciple::findOrFail($id);

        return $getMasterPrinciplebyId;
    }

    public static function storeMasterPrinciple($kode_principle, $nama_principle, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic)
    {
        $storeMasterPrinciple = new MasterPrinciple();
        $storeMasterPrinciple->kode_principle   = $kode_principle;
        $storeMasterPrinciple->nama_principle   = $nama_principle;
        $storeMasterPrinciple->alamat           = $alamat;
        $storeMasterPrinciple->email            = $email;
        $storeMasterPrinciple->no_telp          = $no_telp;
        $storeMasterPrinciple->fax              = $fax;
        $storeMasterPrinciple->nama_pic         = $nama_pic;
        $storeMasterPrinciple->jabatan_pic      = $jabatan_pic;
        $storeMasterPrinciple->save();

        return $storeMasterPrinciple;
    }

    public static function updateMasterPrinciple($id, $kode_principle, $nama_principle, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic)
    {
        $updateMasterPrinciple = MasterPrinciple::find($id);
        $updateMasterPrinciple->kode_principle   = $kode_principle;
        $updateMasterPrinciple->nama_principle   = $nama_principle;
        $updateMasterPrinciple->alamat           = $alamat;
        $updateMasterPrinciple->email            = $email;
        $updateMasterPrinciple->no_telp          = $no_telp;
        $updateMasterPrinciple->fax              = $fax;
        $updateMasterPrinciple->nama_pic         = $nama_pic;
        $updateMasterPrinciple->jabatan_pic      = $jabatan_pic;
        $updateMasterPrinciple->save();

        return $updateMasterPrinciple;
    }

    public static function delMasterPrinciplebyId($id)
    {
        $delMasterPrinciplebyId = MasterPrinciple::destroy($id);

        return $delMasterPrinciplebyId;
    }
}
