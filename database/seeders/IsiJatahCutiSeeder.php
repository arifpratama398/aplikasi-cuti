<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class IsiJatahCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jatah_cuti')->insert([
            [
                'id'=> 1,
                'jatah_cuti'=> 10
            ],
            [
                'id'=> 2,
                'jatah_cuti'=> 10
            ]
        ]);
    }
}
