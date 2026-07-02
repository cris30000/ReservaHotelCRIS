<?php

namespace App\Http\Controllers;

use App\Models\Individual;
use Illuminate\Http\Request;

class IndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $individuals = Individual::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return response()->json($individuals, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $individual = Individual::create($data);

        return response()->json([
            'message' => 'Cliente particular creado correctamente.',
            'data' => $individual
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Individual $individual)
    {
        $individual = Individual::included()->findOrFail($individual->id);

        return response()->json($individual, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Individual $individual)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $individual->update($data);

        return response()->json([
            'message' => 'Cliente particular actualizado correctamente.',
            'data' => $individual
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Individual $individual)
    {
        // Verifica si el cliente tiene reservas
        if ($individual->rooms()->exists()) {

            return response()->json([
                'message' => 'No se puede eliminar el cliente porque tiene reservas asociadas.'
            ], 422);
        }

        $individual->delete();

        return response()->json([
            'message' => 'Cliente particular eliminado correctamente.'
        ], 200);
    }
}