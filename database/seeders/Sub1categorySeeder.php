<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sub1category;

class Sub1categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sub1category::create([
            "maincategory" => 2,
            "name" => "Sample Sub 1 Category",
        ]);
    }
}
