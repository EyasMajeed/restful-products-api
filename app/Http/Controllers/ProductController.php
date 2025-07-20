<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource (all products).
     * Corresponds to: GET /api/products
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all(); // Fetch all products from the database
        return response()->json($products); // Return them as JSON
    }

    /**
     * Store a newly created resource in storage.
     * Corresponds to: POST /api/products
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
            ]);

            // Create a new product instance with the validated data
            $product = Product::create($validatedData);

            // Return a JSON response with the created product and a 201 Created status code
            return response()->json($product, 201); // 201 Created is standard for successful creation
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity is standard for validation failures
        } catch (\Exception $e) {
            // Handle any other unexpected errors
            return response()->json([
                'message' => 'An error occurred while creating the product.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error for server-side issues
        }
    }

    /**
     * Display the specified resource.
     * Corresponds to: GET /api/products/{product}
     *
     * @param  \App\Models\Product  $product (Laravel's Route Model Binding automatically injects the Product)
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        // Laravel's Route Model Binding automatically fetches the product by ID from the URL.
        // If a product with the given ID is not found, Laravel automatically returns a 404 Not Found response.
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     * Corresponds to: PUT/PATCH /api/products/{product}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        try {
            // Validate the incoming request data.
            // 'sometimes' means validate only if the field is present in the request.
            // This allows partial updates (PATCH). For full replacement (PUT), all fields would be required.
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'sometimes|required|numeric|min:0',
            ]);

            // Update the product with the validated data
            $product->update($validatedData);

            // Return a JSON response with the updated product
            return response()->json($product);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Corresponds to: DELETE /api/products/{product}
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete(); // Delete the product

            // Return a 204 No Content response, which is typical for successful deletions
            return response()->json(null, 204); // 204 No Content is standard for successful deletion with no body
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
