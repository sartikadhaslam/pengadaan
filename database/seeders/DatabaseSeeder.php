<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin Pengadaan";
        $user->email = "admin@admin.com";
        $user->menuroles = "pengadaan";
        $user->password = bcrypt('12345678'); 
        $user->save();
    }
}
