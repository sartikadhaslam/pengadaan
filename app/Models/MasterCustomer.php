<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCustomer extends Model
{
    use HasFactory;

    protected $table = 'master_customer';

    protected $fillable = [
        'nama_customer', 
        'alamat', 
        'no_telp',
        'nama_pic'
    ];

    public static function getMasterCustomer()
    {
        $getMasterCustomer = MasterCustomer::orderBy('nama_customer', 'asc')
        ->get();

        return $getMasterCustomer;
    }

    public static function getMasterCustomerbyId($id)
    {
        $getMasterCustomerbyId = MasterCustomer::findOrFail($id);

        return $getMasterCustomerbyId;
    }

    public static function storeMasterCustomer($nama_customer, $alamat, $no_telp, $nama_pic)
    {
        $storeMasterCustomer = new MasterCustomer();
        $storeMasterCustomer->nama_customer = $nama_customer;
        $storeMasterCustomer->alamat = $alamat;
        $storeMasterCustomer->no_telp = $no_telp;
        $storeMasterCustomer->nama_pic = $nama_pic;
        $storeMasterCustomer->save();

        return $storeMasterCustomer;
    }

    public static function updateMasterCustomer($id, $nama_customer, $alamat, $no_telp, $nama_pic)
    {
        $updateMasterCustomer = MasterCustomer::find($id);
        $updateMasterCustomer->nama_customer = $nama_customer;
        $updateMasterCustomer->alamat = $alamat;
        $updateMasterCustomer->no_telp = $no_telp;
        $updateMasterCustomer->nama_pic = $nama_pic;
        $updateMasterCustomer->save();

        return $updateMasterCustomer;
    }

    public static function delMasterCustomerbyId($id)
    {
        $delMasterCustomerbyId = MasterCustomer::destroy($id);

        return $delMasterCustomerbyId;
    }
}
