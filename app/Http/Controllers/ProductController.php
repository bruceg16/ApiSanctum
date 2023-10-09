<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return $product;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validators = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required|between:0,99.99',
        ]);

        if ($Validators->fails()) {
            return response()->json($Validators->errors());
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        if ($product) {
            return response()->json(['data' => $product]);
        }
        return response()->json(['error' => 'No Create Product'], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json(['data' => $product],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Validators = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required|between:0,99.99',
        ]);

        if ($Validators->fails()) {
            return response()->json($Validators->errors());
        }
        try {
            $producto = Product::findOrFail($id);
            if ($producto) {
                $producto->update($request->all());
                return response()->json(['data' => $producto], 201);
            }
        } catch (\Exception $e) {
            return  response()->json([
                'message' => $e->getMessage(),
                'error' => 'Error updating product'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $producto = Product::findOrFail($id);
            if ($producto) {
                $producto->delete();
                return   response()->json(['success' => 'Se Elimino']);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error removing',
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
