<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hops\Hop;
use App\Malts\Malt;
use App\Beers\Beer;
use App\System\Unit;
use App\Beers\Recipe;
use App\Beers\HopAddition;
use App\Http\Requests\StoreRecipeRequest;

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
        $this->authorize('update', $beer);

        $units = Unit::whereIn('symbol', ['gal', 'l'])->pluck('symbol', 'id');

        return view('beers.recipes.create', [
            'beer' => $beer,
            'units' => $units,
            'recipe' => new Recipe,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request, Beer $beer)
    {
        $this->authorize('update', $beer);

        $recipe = new Recipe;
        $recipe->fill($request->all());
        $recipe->beer_id = $beer->id;
        $recipe->user_id = auth()->user()->id;
        
        $recipe->save();

        if ($request->has('hops')) {
            $recipe->hop_additions()->createMany($request->input('hops'));
        }

        if ($request->has('malts')) {
            $recipe->malt_additions()->createMany($request->input('malts'));
        }

        if ($request->has('yeasts')) {
            $recipe->yeast_additions()->createMany($request->input('yeasts'));
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
    public function edit(Beer $beer, Recipe $recipe)
    {
        $this->authorize('update', $recipe);
        
        $units = Unit::whereIn('symbol', ['gal', 'l'])->pluck('symbol', 'id');
        
        return view('beers.recipes.edit', [
            'beer' => $beer,
            'units' => $units,
            'recipe' => $recipe,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beer $beer, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $recipe->update($request->all());

        if ($request->has('hops')) {
            $this->updateHopAdditions($request->get('hops'), $recipe);
        }

        return redirect()->route('beers.recipes.edit', [$beer->slug, $recipe->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
         $this->authorize('delete', $recipe);
    }

    private function updateHopAdditions($hops, $recipe)
    {
        $hops_collection = collect($hops);
        $hops_collection->each(function($hop) use ($recipe) {
            $hop = (object) $hop;
            HopAddition::updateOrCreate(['id' => $hop->id ?? null], [
                'hop_id' => $hop->hop_id,
                'recipe_id' => $recipe->id,
                'hop_type_id' => $hop->hop_type_id,
                'hop_method_id' => $hop->hop_method_id,
                'unit_id' => $hop->unit_id,
                'amount' => $hop->amount,
                'minute' => $hop->minute,
            ]);
        });

        HopAddition::where('recipe_id', $recipe->id)
            ->whereNotIn('id', $hops_collection->pluck('id'))
            ->delete();
    }
}
