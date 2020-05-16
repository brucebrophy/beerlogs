<?php

use App\Yeasts\Yeast;
use Illuminate\Database\Seeder;

class YeastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yeasts = json_decode(file_get_contents(storage_path('data/yeast.json')));

        foreach ($yeasts as $yeast) {
            Yeast::create([
                'name' => trim($yeast->Name),
                'strain' => isset($yeast->Strain) ? trim($yeast->Strain) : null,
                'description' => isset($yeast->Notes) ? trim($yeast->Notes) : null,
            ]);
        }
    }
}
