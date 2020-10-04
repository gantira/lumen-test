<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    use ApiResponser;

    /**
     * Return the list of products
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return $this->successResponse($products);
    }

    /**
     * Create one new product
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $product = Product::create($request->all());

        return $this->successResponse($product, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one product
     * @return Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::findOrFail($product);

        return $this->successResponse($product);
    }

    /**
     * Update an existing product
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $rules = [
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $product = Product::findOrFail($product);

        $product->fill($request->all());

        if ($product->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product->save();

        return $this->successResponse($product);
    }

    /**
     * Remove an existing product
     * @return Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::findOrFail($product);

        $product->delete();

        return $this->successResponse($product);
    }
}
