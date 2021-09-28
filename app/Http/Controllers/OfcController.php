<?php

namespace App\Http\Controllers;

use App\Ofc;
use Illuminate\Http\Request;

class OfcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'OfcController';
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
     * @param  \App\Ofc  $ofc
     * @return \Illuminate\Http\Response
     */
    public function show(Ofc $ofc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ofc  $ofc
     * @return \Illuminate\Http\Response
     */
    public function edit(Ofc $ofc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ofc  $ofc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ofc $ofc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ofc  $ofc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ofc $ofc)
    {
        //
    }
}
