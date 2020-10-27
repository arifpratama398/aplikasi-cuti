<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Arief Pratama',
               'email'=>'arifpratama398@gmail.com',
                'is_admin'=>'1',
               'password' => bcrypt('latihan1234'),
               'position' => 'Administrator',
            ],
            [
               'name'=>'Arif Naga Pratama',
               'email'=>'naga.arif912@gmail.com',
                'is_admin'=>'0',
               'password'=> bcrypt('latihan1234'),
               'position' => 'Developer'
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
