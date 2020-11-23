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
        User::create([
            'name' => 'Marco Garcia',
            'email' => 'magrmobile@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('hanoi2979'), // secret
            'dni' => '027036616',
            'address' => '',
            'phone' => '',
            'role' => 'admin',
        ]);
        factory(User::class, 50)->create();
    }
}
