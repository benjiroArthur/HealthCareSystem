<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'out_patient',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'doctor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'pharmacy',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
