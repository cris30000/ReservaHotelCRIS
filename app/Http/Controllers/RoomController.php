<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return response()->json($rooms, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string|max:10',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $room = Room::create($data);

        return response()->json([
            'message' => 'Habitación creada correctamente.',
            'data' => $room
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room = Room::included()->findOrFail($room->id);

        return response()->json($room, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'number' => 'required|string|max:10',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $room->update($data);

        return response()->json([
            'message' => 'Habitación actualizada correctamente.',
            'data' => $room
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Verificar si la habitación tiene reservas
        if (
            $room->agencies()->exists() ||
            $room->individuals()->exists()
        ) {
            return response()->json([
                'message' => 'No se puede eliminar la habitación porque tiene reservas asociadas.'
            ], 422);
        }

        $room->delete();

        return response()->json([
            'message' => 'Habitación eliminada correctamente.'
        ], 200);
    }
}