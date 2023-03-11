<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input['name'] = "Jaksel Jawa";
        $input['address'] = "Jakarta Selatan";
        $input['phone'] = "082131940020";
        Outlet::create($input);
    }
}
