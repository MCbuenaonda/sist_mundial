<?php

namespace App\Http\Controllers;

use App\Uefa;
use Illuminate\Http\Request;

class UefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uefa = Uefa::all();
        $confederacion = $uefa[0]->pais->confederacion;
        return view('uefa.index', compact('confederacion','uefa'));
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
     * @param  \App\Uefa  $uefa
     * @return \Illuminate\Http\Response
     */
    public function show(Uefa $uefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Uefa  $uefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Uefa $uefa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Uefa  $uefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uefa $uefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Uefa  $uefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uefa $uefa)
    {
        //
    }
}
