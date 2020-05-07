<?php

use App\Models\Beers\Malt;
use Illuminate\Database\Seeder;

class MaltSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $malts = json_decode(file_get_contents(storage_path('data/malts.json')));

        foreach ($malts as $malt) {
            Malt::create([
                'name' => trim($malt->Grain),
                'description' => trim($malt->Description),
            ]);
        }
    }
}
