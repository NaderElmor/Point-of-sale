<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@app.com',
            'password' => bcrypt('111'),
        ]);

        $user->attachRole('super_admin');
    }
}
