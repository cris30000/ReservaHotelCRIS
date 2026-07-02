<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencies = Agency::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return response()->json($agencies, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'name_contact' => 'required|string|max:255',
        ]);

        $agency = Agency::create($data);

        return response()->json([
            'message' => 'Agencia creada correctamente.',
            'data' => $agency
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        $agency = Agency::included()->findOrFail($agency->id);

        return response()->json($agency, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agency $agency)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'name_contact' => 'required|string|max:255',
        ]);

        $agency->update($data);

        return response()->json([
            'message' => 'Agencia actualizada correctamente.',
            'data' => $agency
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        // Verifica si la agencia tiene reservas asociadas
        if ($agency->rooms()->exists()) {

            return response()->json([
                'message' => 'No se puede eliminar la agencia porque tiene reservas asociadas.',
            ], 422);
        }

        $agency->delete();

        return response()->json([
            'message' => 'Agencia eliminada correctamente.'
        ], 200);
    }
}