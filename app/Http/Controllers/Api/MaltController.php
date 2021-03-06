<?php

namespace App\Http\Controllers\Api;

use App\Malts\Malt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @param  \App\Malts\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function show(Malt $malt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Malts\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Malt $malt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Malts\Malt  $malt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Malt $malt)
    {
        //
    }
}
