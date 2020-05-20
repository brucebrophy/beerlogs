<?php

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
        $this->call(UnitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BeerStyleSeeder::class);
        $this->call(HopSeeder::class);
        $this->call(HopTypeSeeder::class);
        $this->call(HopMethodSeeder::class);
        $this->call(MaltSeeder::class);
        $this->call(YeastSeeder::class);

        if(config('app.env') === 'local') {
            $this->call(SampleSeeder::class);
        }
    }
}
