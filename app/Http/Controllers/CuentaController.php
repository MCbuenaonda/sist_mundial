<?php

namespace App\Http\Controllers;

use App\User;
use App\Cuenta;
use Illuminate\Http\Request;
use App\Resources\MundialResources;

class CuentaController extends Controller
{

    public function __construct(){
        $this->lib = new MundialResources;
        $this->middleware(['auth', 'verified']);
    }

    public function index(User $user){
        $cuenta = Cuenta::where('user_id', $user->id)->first();

        foreach ($cuenta->inversiones as $inversion) {
            //$historia = [...$inversion->pais->partidosL, ...$inversion->pais->partidosV];
            $historia = $inversion->pais->partidosL->merge($inversion->pais->partidosV);
            //dd($hist);
            //$historia = $inversion->pais->partidosL;
            $inversion->historia = $historia;

            foreach ($inversion->historia as $hist) {
                $hist->fase = $hist->fase;
                $hist->ciudad = $hist->Ciudad;
                $hist->fecha = $this->lib->_parseFecha($hist->fecha);
                $hist->paisL = $hist->paisL;
                $hist->paisL->images = $hist->paisL->images;
                $hist->paisV = $hist->paisV;
                $hist->paisV->images = $hist->paisV->images;
            }
        }

        return view('cuenta.index', compact('cuenta'));
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
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        //
    }
}
