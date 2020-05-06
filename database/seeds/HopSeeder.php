<?php

use App\Models\Beers\Hop;
use Illuminate\Database\Seeder;

class HopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hops = json_decode(file_get_contents(storage_path('data/hops.json')));

        foreach ($hops as $hop) {
            Hop::create([
                'name' => trim($hop->Variety),
                'description' => trim($hop->Description),
            ]);
        }
    }
}
