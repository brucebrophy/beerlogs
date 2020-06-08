<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Yeasts\Yeast;
use Illuminate\Http\Request;

class YeastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yeasts = Yeast::orderBy('name')->get(['id', 'name']);

        return response()->json([
            'yeasts' => $yeasts,
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
     * @param  \App\Yeasts\Yeast  $yeast
     * @return \Illuminate\Http\Response
     */
    public function show(Yeast $yeast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Yeasts\Yeast  $yeast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Yeast $yeast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Yeasts\Yeast  $yeast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Yeast $yeast)
    {
        //
    }
}
