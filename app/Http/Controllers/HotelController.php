<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function index()
    {
        $hoteles = Hotel::all(); // Guardamos los datos en la variable
        return response()->json($hoteles); // Devolvemos la variable en JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $camposValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'galeria_fotos' => 'required|array'
        ]);

        $hotel = Hotel::create($camposValidados);

        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Carga el hotel pero se trae de golpe todas sus habitaciones asociadas en PostgreSQL
       return response()->json(Hotel::with('habitaciones')->findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
