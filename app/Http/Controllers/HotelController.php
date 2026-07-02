<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return response()->json($hotels, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'año'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
        ]);

        $hotel = Hotel::create($data);

        return response()->json([
            'message' => 'Hotel creado correctamente.',
            'data' => $hotel
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $hotel = Hotel::included()->findOrFail($hotel->id);

        return response()->json($hotel, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'año'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
        ]);

        $hotel->update($data);

        return response()->json([
            'message' => 'Hotel actualizado correctamente.',
            'data' => $hotel
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        // No permitir eliminar hoteles que tengan habitaciones
        if ($hotel->rooms()->exists()) {

            return response()->json([
                'message' => 'No se puede eliminar el hotel porque tiene habitaciones asociadas.'
            ], 422);
        }

        $hotel->delete();

        return response()->json([
            'message' => 'Hotel eliminado correctamente.'
        ], 200);
    }
}