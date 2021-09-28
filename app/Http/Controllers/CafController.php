<?php

namespace App\Http\Controllers;

use App\Caf;
use Illuminate\Http\Request;

class CafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'CafController';
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
     * @param  \App\Caf  $caf
     * @return \Illuminate\Http\Response
     */
    public function show(Caf $caf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Caf  $caf
     * @return \Illuminate\Http\Response
     */
    public function edit(Caf $caf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caf  $caf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caf $caf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caf  $caf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caf $caf)
    {
        //
    }
}
