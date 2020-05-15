<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beers\Malt;
use Illuminate\Http\Request;

class MaltController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $malts = Malt::orderBy('name')->get(['id', 'name']);

        return response()->json([
            'malts' => $malts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beers\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function show(Malt $malt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beers\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function edit(Malt $malt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beers\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Malt $malt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beers\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Malt $malt)
    {
        //
    }
}
