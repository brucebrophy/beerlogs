<?php

namespace App\Http\Controllers;

use App\Beers\Beer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBeer;
use App\Http\Requests\UpdateBeer;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beers = Beer::with([
            'style'
        ])->paginate(20);

        return view('beers.index', [
            'beers' => $beers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beer = new Beer;
        return view('beers.create', [
            'beer' => $beer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBeer $request)
    {
        $beer = new Beer;
        $beer->fill($request->input());
        $beer->user_id = auth()->id();
        $beer->save();

        return redirect()->route('beers.recipes.create', $beer->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function show(Beer $beer)
    {
        $beer->load([
            'style',
            'recipes',
            'recipes.hop_additions',
            'recipes.hop_additions.hop',
            'recipes.hop_additions.type',
            'recipes.malt_additions.malt',
            'recipes.yeast_additions.yeast',
        ]);

        return view('beers.show', [
            'beer' => $beer,
            'current_recipe' => $beer->recipes->first() ?? null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function edit(Beer $beer)
    {
        $this->authorize('update', $beer);
        
        $beer->load([
            'style'
        ]);

        return view('beers.edit', [
            'beer' => $beer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeer $request, Beer $beer)
    {
        $this->authorize('update', $beer);

        $beer->update($request->input());

        return view('beers.show', [
            'beer' => $beer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Beer $beer)
    {
        $this->authorize('delete', $beer);

        $request->validate([
            'name' => 'required'
        ]);

        if ($request->input('name') !== $beer->name) {
            return redirect()
                ->route('beers.edit', $beer->slug)
                ->with('error', 'The typed name does not match.');
        }

        $beer->delete();
        
        return redirect()->route('beers.index');
    }
}
