<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
        ]);
    }
}
