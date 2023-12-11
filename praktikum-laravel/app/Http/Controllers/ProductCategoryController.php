<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryRecource;
use Exception;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $queryData = ProductCategory::all();
            $formattedDatas = new ProductCategoryCollection($queryData);
            return response()->json([
                "message" =>"succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = ProductCategory::create($validatedRequest);
            $formattedDatas = new ProductCategoryRecource($queryData);
            return response()->json([
                "message" =>"succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $formattedDatas = new ProductCategoryRecource($queryData);
            return response()->json([
                "message" =>"succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
        try {
            $queryData = ProductCategory::findOrFail($id);
            $queryData -> update($validatedRequest);
            $queryData -> save();
            $formattedDatas = new ProductCategoryRecource($queryData);
            return response()->json([
                "message" =>"succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $queryData = ProductCategory::findOrFail($id);
            $queryData->delete();
            $formattedDatas = new ProductCategoryRecource($queryData);
            return response()->json([
                "message" =>"succes",
                "data" => $formattedDatas
            ],200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),400);
        }
    }
}
