<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Hotel;
use App\Models\Individual;

class ConsultasController extends Controller
{
    /**
     * 2.1 Traer todas las reservas realizadas por una agencia.
     */
    public function reservasAgencias()
    {
        $agencies = Agency::with([
            'rooms.hotel'
        ])->get();

        return response()->json($agencies, 200);
    }

    /**
     * 2.2 Traer todas las reservas realizadas por particulares.
     */
    public function reservasParticulares()
    {
        $individuals = Individual::with([
            'rooms.hotel'
        ])->get();

        return response()->json($individuals, 200);
    }

    /**
     * 2.3 Listar todos los hoteles con su categoría.
     */
    public function hotelesCategorias()
    {
        $hotels = Hotel::with('category')->get();

        return response()->json($hotels, 200);
    }
}