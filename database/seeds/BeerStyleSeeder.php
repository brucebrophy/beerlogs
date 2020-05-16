<?php

use Illuminate\Database\Seeder;

use App\Beers\Style;

class BeerStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $styles = [
            'American Pale Lager',
            'American Pale Ale (APA)',
            'American IPA',
            'American Double / Imperial IPA',
            'Oatmeal Stout',
            'American Porter',
            'Saison / Farmhouse Ale',
            'Belgian IPA',
            'Cider',
            'Baltic Porter',
            'Tripel',
            'American Barleywine',
            'Winter Warmer',
            'American Stout',
            'Fruit / Vegetable Beer',
            'English Strong Ale',
            'American Black Ale',
            'Belgian Dark Ale',
            'American Blonde Ale',
            'American Amber / Red Ale',
            'Berliner Weissbier',
            'American Brown Ale',
            'American Pale Wheat Ale',
            'Belgian Strong Dark Ale',
            'Kölsch',
            'English Pale Ale',
            'American Amber / Red Lager',
            'English Barleywine',
            'Milk / Sweet Stout',
            'German Pilsener',
            'Pumpkin Ale',
            'Belgian Pale Ale',
            'American Pilsner',
            'American Wild Ale',
            'English Brown Ale',
            'Altbier',
            'California Common / Steam Beer',
            'Gose',
            'Cream Ale',
            'Vienna Lager',
            'Witbier',
            'American Double / Imperial Stout',
            'Munich Helles Lager',
            'Schwarzbier',
            'Märzen / Oktoberfest',
            'Extra Special / Strong Bitter (ESB)',
            'Rye Beer',
            'Euro Dark Lager',
            'Hefeweizen',
            'Foreign / Export Stout',
            'Other',
            'English India Pale Ale (IPA)',
            'Czech Pilsener',
            'American Strong Ale',
            'Mead',
            'Euro Pale Lager',
            'American White IPA',
            'Dortmunder / Export Lager',
            'Irish Dry Stout',
            'Scotch Ale / Wee Heavy',
            'Munich Dunkel Lager',
            'Radler',
            'Bock',
            'English Dark Mild Ale',
            'Irish Red Ale',
            'Rauchbier',
            'Bière de Garde',
            'Doppelbock',
            'Dunkelweizen',
            'Belgian Strong Pale Ale',
            'Dubbel',
            'Quadrupel (Quad)',
            'Russian Imperial Stout',
            'English Pale Mild Ale',
            'Maibock / Helles Bock',
            'Herbed / Spiced Beer',
            'American Adjunct Lager',
            'Scottish Ale',
            'Smoked Beer',
            'Light Lager',
            'Abbey Single Ale',
            'Roggenbier',
            'Kristalweizen',
            'American Dark Wheat Ale',
            'English Stout',
            'Old Ale',
            'American Double / Imperial Pilsner',
            'Flanders Red Ale',
            'Keller Bier / Zwickel Bier',
            'American India Pale Lager',
            'Shandy',
            'Wheat Ale',
            'American Malt Liquor',
            'English Bitter',
            'Chile Beer',
            'Grisette',
            'Flanders Oud Bruin',
            'Braggot',
            'Low Alcohol Beer',
        ];

        foreach ($styles as $style) {
            Style::create([
                'name' => $style,
            ]);
        }
    }
}
