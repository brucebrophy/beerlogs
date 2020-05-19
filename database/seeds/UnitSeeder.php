<?php

use Illuminate\Database\Seeder;
use App\System\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            // mass
            [
                'name' => 'Ounce',
                'symbol' => 'oz',
            ],
            [
                'name' => 'Pound',
                'symbol' => 'lb',
            ],
            [
                'name' => 'Gram',
                'symbol' => 'g',
            ],
            [
                'name' => 'Kilogram',
                'symbol' => 'kg',
            ],

            // volume
            [
                'name' => 'Quart',
                'symbol' => 'qt',
            ],
            [
                'name' => 'Gallon',
                'symbol' => 'gal',
            ],
            [
                'name' => 'Millilitre',
                'symbol' => 'ml',
            ],
            [
                'name' => 'Litre',
                'symbol' => 'l',
            ],
        ];

        foreach ($units as $unit) {
            $unit = (object) $unit;
            Unit::create([
                'name' => $unit->name,
                'symbol' => $unit->symbol,
            ]);
        }
    }
}
