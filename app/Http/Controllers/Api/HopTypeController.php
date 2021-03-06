<?php

namespace App\Http\Controllers\Api;

use App\Hops\HopType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HopTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = HopType::orderBy('name')->get(['id', 'name']);
        return response()->json([
            'types' => $types,
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
     * @param  \App\Hops\HopType  $hopType
     * @return \Illuminate\Http\Response
     */
    public function show(HopType $hopType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hops\HopType  $hopType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HopType $hopType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hops\HopType  $hopType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HopType $hopType)
    {
        //
    }
}
