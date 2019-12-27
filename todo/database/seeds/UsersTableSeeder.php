<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1;$i <= 10; $i++) {
            User::create([
                'user'           => 'test_user'.$i,
                'password'       => Hash::make('12345678'),
                'family_name'    => 'テスト'.$i,
                'first_name'     => '太郎'.$i,
                'is_admin'       => '0',
                'remember_token' => str_random(10),
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
        }
    }
}
