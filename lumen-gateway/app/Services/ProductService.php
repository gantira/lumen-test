<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class ProductService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the products service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the products service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.products.base_uri');
        $this->secret = config('services.products.secret');
    }

    /**
     * Obtain the full list of product from the product service
     * @return string   
     */
    public function obtainProducts()
    {
        return $this->performRequest('GET', '/products');
    }

    
    /**
     * Create one product using product service
     * @return string   
     */
    public function createProduct($data)
    {
        return $this->performRequest('POST', '/products', $data);
    }

    /**
     * Obtain one single product from the product service
     * @return string   
     */
    public function obtainProduct($product)
    {
        return $this->performRequest('GET', "/products/{$product}");
    }

    /**
     * Update an intance of product using the product service
     * @return string   
     */
    public function editProduct($data, $product)
    {
        return $this->performRequest('PUT', "/products/{$product}", $data);
    }

    /**
     * Remove a single product using the product service
     * @return string   
     */
    public function deleteProduct($product)
    {
        return $this->performRequest('DELETE', "/products/{$product}");
    }
}
