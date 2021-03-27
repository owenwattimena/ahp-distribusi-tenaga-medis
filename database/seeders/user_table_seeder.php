<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::create([
            "nama" => "Admin",
            "alamat" => "Wayame",
            "username" => "admin",
            "password" =>  Hash::make("admin"),
        ]);
    }
}