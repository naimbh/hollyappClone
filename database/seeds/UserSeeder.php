<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'naimbh',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'is_paid' => 1,
            'subscriptionId' =>'I-X7VN0R2Y5D25',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'is_admin' => 0,
            'is_paid' => 1,
            'subscriptionId' =>'I-X7VN0R2Y5D26',
            'password' => bcrypt('12345678'),
        ]);
    }
}
