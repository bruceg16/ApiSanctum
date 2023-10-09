<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 5; $i++){ 
        Db::table('products')->insert([
            'name'=> "Product ".$i,
            'description' => "Description of Product ".$i,
            'amount' => 988
        ]);
        }
    }
}
