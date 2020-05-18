<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hops\Hop;
use App\Malts\Malt;
use App\Beers\Beer;
use App\Beers\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Beer $beer)
    {          
        return view('beers.recipes.create', [
            'beer' => $beer,
            'recipe' => new Recipe,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Beer $beer)
    {
        $recipe = new Recipe;
        
        $recipe->fill($request->only([
            'abv',
            'og',
            'fb',
            'srm',
        ]));
        
        $recipe->beer_id = $beer->id;
        
        $recipe->save();

        if ($request->has('hops')) {
            $recipe->hop_additions()->createMany($request->input('hops'));
        }

        return redirect()->route('beers.show', $beer->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
