<?php

use App\Hops\HopMethod;
use Illuminate\Database\Seeder;

class HopMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            [
                'name' => 'Mash',
                'slug' => 'mash',
            ],
            [
                'name' => 'First Wort',
                'slug' => 'first-wort',
            ],
            [
                'name' => 'Boil',
                'slug' => 'boil',
            ],
            [
                'name' => 'Whirlpool',
                'slug' => 'whirlpool',
            ],
            [
                'name' => 'Hop Bursting',
                'slug' => 'hop-bursting',
            ],
            [
                'name' => 'Dry Hopped',
                'slug' => 'dry-hopped',
            ],
        ];
            

        foreach ($methods as $method) {
            $method = (object) $method;
            HopMethod::create([
                'name' => $method->name,
                'slug' => $method->slug,
            ]);
        }
    }
}
