<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the products microservice
     * @var ProductService
     */
    public $productService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Return the list of products
     * return Illuminte/Http/Response
     */
    public function index()
    {
        return $this->successResponse($this->productService->obtainProducts());
    }

    /**
     * Create new one product
     * @return Illuminate/Http/Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->productService->createProduct($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obtains and show one product
     * @return Illuminate/Http/Response
     */
    public function show($product)
    {
        return $this->successResponse($this->productService->obtainProduct($product));
    }

    /**
     * Update an existing product
     * @return Illuminate/Http/Response
     */
    public function update(Request $request, $product)
    {
        return $this->successResponse($this->productService->editProduct($request->all(), $product));
    }

    /**
     * Remove an existing product
     * @return Illuminate/Http/Response
     */
    public function destroy($product)
    {
        return $this->successResponse($this->productService->deleteProduct($product));
    }
}
