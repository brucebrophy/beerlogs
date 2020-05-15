<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beers\Hop;
use Illuminate\Http\Request;

class HopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hops = Hop::orderBy('name')->get(['id', 'name']);
        
        return response()->json([
            'hops' => $hops,
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
     * @param  \App\Models\Beers\Hop  $hop
     * @return \Illuminate\Http\Response
     */
    public function show(Hop $hop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beers\Hop  $hop
     * @return \Illuminate\Http\Response
     */
    public function edit(Hop $hop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beers\Hop  $hop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hop $hop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beers\Hop  $hop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hop $hop)
    {
        //
    }
}
