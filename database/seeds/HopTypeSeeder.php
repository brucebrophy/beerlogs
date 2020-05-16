<?php

use App\Hops\HopType;
use Illuminate\Database\Seeder;

class HopTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Whole Leaf',
                'slug' => 'whole-leaf',
            ],
            [
                'name' => 'Wet Hops',
                'slug' => 'wet-hops',
            ],
            [
                'name' => 'Hop Plugs',
                'slug' => 'hop-plugs',
            ],
            [
                'name' => 'Pellet Hops',
                'slug' => 'pellet-hops',
            ],
            [
                'name' => 'Hops Extract',
                'slug' => 'hops-extract',
            ],
            [
                'name' => 'Hops Powder',
                'slug' => 'hops-powder',
            ],
        ];

        foreach ($types as $type) {
            $type = (object) $type;
            HopType::create([
                'name' => $type->name,
                'slug' => $type->slug,
            ]);
        }
    }
}
