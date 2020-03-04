<?php

use Illuminate\Database\Seeder;

class Area extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Area::create([
            'area_name'=>"Panthapath",
            'area_address'=>"Concord-Regency,Panthapath, Dhaka",
        ]);
    }
}
