<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCustomer extends Model
{
    use HasFactory;

    protected $table = 'master_customer';

    protected $fillable = [
        'kode_customer',
        'nama_customer', 
        'alamat', 
        'email',
        'no_telp',
        'fax',
        'nama_pic',
        'jabatan_pic',
        'payment_terms',
    ];

    public static function getMasterCustomer()
    {
        $getMasterCustomer = MasterCustomer::orderBy('nama_customer', 'asc')
        ->paginate(5);

        return $getMasterCustomer;
    }

    public static function getMasterCustomerbyId($id)
    {
        $getMasterCustomerbyId = MasterCustomer::findOrFail($id);

        return $getMasterCustomerbyId;
    }

    public static function storeMasterCustomer($kode_customer, $nama_customer, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic, $payment_terms)
    {
        $storeMasterCustomer = new MasterCustomer();
        $storeMasterCustomer->kode_customer = $kode_customer;
        $storeMasterCustomer->nama_customer = $nama_customer;
        $storeMasterCustomer->alamat        = $alamat;
        $storeMasterCustomer->email         = $email;
        $storeMasterCustomer->no_telp       = $no_telp;
        $storeMasterCustomer->fax           = $fax;
        $storeMasterCustomer->nama_pic      = $nama_pic;
        $storeMasterCustomer->jabatan_pic   = $jabatan_pic;
        $storeMasterCustomer->payment_terms = $payment_terms;
        $storeMasterCustomer->save();

        return $storeMasterCustomer;
    }

    public static function updateMasterCustomer($id, $kode_customer,$nama_customer, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic, $payment_terms)
    {
        $updateMasterCustomer = MasterCustomer::find($id);
        $updateMasterCustomer->kode_customer     = $kode_customer;
        $updateMasterCustomer->nama_customer     = $nama_customer;
        $updateMasterCustomer->alamat            = $alamat;
        $updateMasterCustomer->email             = $email;
        $updateMasterCustomer->no_telp           = $no_telp;
        $updateMasterCustomer->fax               = $fax;
        $updateMasterCustomer->nama_pic          = $nama_pic;
        $updateMasterCustomer->jabatan_pic       = $jabatan_pic;
        $updateMasterCustomer->payment_terms     = $payment_terms;
        $updateMasterCustomer->save();

        return $updateMasterCustomer;
    }

    public static function delMasterCustomerbyId($id)
    {
        $delMasterCustomerbyId = MasterCustomer::destroy($id);

        return $delMasterCustomerbyId;
    }
}
