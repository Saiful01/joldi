<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \App\User::create([
            'name' => "Motiur",
            'email' => "memotiur@gmail.com",
            'password' => Hash::make('123456'),
        ]);
        \App\User::create([
            'name' => "Saiful",
            'email' => "saiful013101@gmail.com",
            'password' => Hash::make('1234'),
        ]);


        $this->call(Area::class);
        $this->call(ParcelType::class);

        \App\Merchant::create([

            'merchant_email' => "saiful013101@gmail.com",
            'merchant_name' => "Saiful",
            'merchant_phone' => "455",
            'password' => Hash::make('1234'),
            'area_id' => 1,
            'active_status' => 1,
        ]);
        \App\Merchant::create([

            'merchant_email' => "memotiur@gmail.com",
            'merchant_name' => "Saiful",
            'merchant_phone' => "455",
            'password' => Hash::make('123456'),
            'area_id' => 1,
            'active_status' => 1,
        ]);


        \App\CurrentLocation::create([
            'lat' => "23.7759739",
            'lon' => "92.373774",
            'delivery_man_id' => 1,
            'address' => "Mirpur-1, Dhaka",
        ]);

        \App\CurrentLocation::create([
            'lat' => "23.781943",
            'lon' => "90.373774",
            'delivery_man_id' => 1,
            'address' => "Rajsha-1, Dhaka",
        ]);

        \App\CurrentLocation::create([
            'lat' => "23.782100",
            'lon' => "90.371113",
            'delivery_man_id' => 1,
            'address' => "Mohakhali-1, Dhaka",
        ]);


    }
}
