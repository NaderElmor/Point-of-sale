<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name'     => 'Nader Elmor',
            'address'  => 'Dumyat, Fariskur',
            'phone'    => '01018168446'
        ]);
    }
}
