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
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Paciente 1',
            'email' => 'patient@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('hanoi2979'), // secret
            'role' => 'patient',
        ]);

        User::create([
            'name' => 'Medico 1',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('hanoi2979'), // secret
            'role' => 'doctor',
        ]);

        factory(User::class, 50)->states('patient')->create();
    }
}
