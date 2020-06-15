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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
    {
        $beers = Beer::public()->with([
            'style',
            'recipes',
        ])->paginate(20);

        return view('beers.index', [
            'beers' => $beers,
        ]);
    }


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
	 * @param  Beer  $beer
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function show(Beer $beer)
    {
        $this->authorize('view', $beer);

        $beer->load([
            'style',
            'recipes.hop_additions.hop',
            'recipes.hop_additions.type',
            'recipes.hop_additions.method',
            'recipes.hop_additions.unit',
            'recipes.malt_additions.malt',
            'recipes.malt_additions.unit',
            'recipes.yeast_additions.yeast',
        ]);

        return view('beers.show', [
            'beer' => $beer,
            'recipe' => $beer->recipes->first() ?? null,
        ]);
    }


	/**
	 * @param  Beer  $beer
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit(Beer $beer)
    {
        $this->authorize('update', $beer);
        
        $styles = Style::orderBy('name')->pluck('name', 'id');
        $beer->load([
            'style'
        ]);

        return view('beers.edit', [
            'beer' => $beer,
            'styles' => $styles,
        ]);
    }


	/**
	 * @param  UpdateBeer  $request
	 * @param  Beer  $beer
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function update(UpdateBeer $request, Beer $beer)
    {
        $this->authorize('update', $beer);

        $beer->update($request->input());

        return redirect()->route('beers.show', $beer->slug);
    }


	/**
	 * @param  Request  $request
	 * @param  Beer  $beer
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
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

        $beer->comments()->delete();
        $beer->delete();
        
        return redirect()->route('beers.index');
    }
}
