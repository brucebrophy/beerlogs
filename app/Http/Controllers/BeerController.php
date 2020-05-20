<?php

namespace App\Http\Controllers;

use App\Beers\Beer;
use App\Beers\Style;
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
        $styles = Style::orderBy('name')->pluck('name', 'id');
        return view('beers.create', [
            'beer' => $beer,
            'styles' => $styles,
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
            'recipes.hop_additions.hop',
            'recipes.hop_additions.type',
            'recipes.hop_additions.method',
            'recipes.hop_additions.unit',
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
        $styles = Style::orderBy('name')->pluck('name', 'id');

        return view('beers.edit', [
            'beer' => $beer,
            'styles' => $styles,
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

        return redirect()->route('beers.show', $beer->slug);
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
            'confirm_name' => 'required'
        ]);

        if ($request->input('confirm_name') !== $beer->name) {
            return redirect()
                ->route('beers.edit', $beer->slug)
                ->with('error', 'The typed name does not match.');
        }

        $beer->delete();
        
        return redirect()->route('beers.index');
    }
}
