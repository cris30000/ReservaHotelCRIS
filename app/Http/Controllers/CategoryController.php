<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string|max:255|unique:categories,description',
            'iva' => 'required|numeric|min:0|max:100',
        ]);

        $category = Category::create($data);

        return response()->json([
            'message' => 'Categoría creada correctamente.',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::included()->findOrFail($category->id);

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'description' => 'required|string|max:255|unique:categories,description,' . $category->id,
            'iva' => 'required|numeric|min:0|max:100',
        ]);

        $category->update($data);

        return response()->json([
            'message' => 'Categoría actualizada correctamente.',
            'data' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->hotels()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar la categoría porque tiene hoteles asociados.',
                'hotels_count' => $category->hotels()->count()
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Categoría eliminada correctamente.'
        ], 200);
    }
}