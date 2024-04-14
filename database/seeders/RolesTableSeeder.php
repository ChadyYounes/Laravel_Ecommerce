<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\table;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('roles')->insert([
        ['name' => 'buyer'],
        ['name' => 'seller'],
        ['name' => 'admin'],
    ]);

    $hashedPassword = Hash::make('admin2024');
   DB::table('users')->insert([
       [
           'name' => 'admin',
           'email' => 'admin2024@gmail.com',
           'email_verified_at' => now(),
           'password' => $hashedPassword,
           'role_id' => 3,
       ],
   ]);
   DB::table('profiles')->insert([
    [
        'full_name' => 'admin',
        'birth_day' => 'admin',
        'country' => 'admin',
        'phone' => 'admin',
        'address' => 'admin',
        'user_id' => 1,
    ],
]);
   DB::table('currencies')->insert([
       ['currency_code'=>'USD','currency_name'=>'US Dollar'],
       ['currency_code'=>'LBP','currency_name'=>'Lebanese Pound'],
       ['currency_code'=>'EUR','currency_name'=>'Euro'],
       ['currency_code'=>'KWD','currency_name'=>'Kuwaiti Dinar']
   ]);
}

}
