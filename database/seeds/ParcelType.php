<?php

use Illuminate\Database\Seeder;

class ParcelType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\ParcelType::create([
            'title'=>"Below 2 KG",
            'charge'=>"30",
        ]);
        \App\ParcelType::create([
            'title'=>"Up to 2 KG",
            'charge'=>"50",
        ]);
    }
}
