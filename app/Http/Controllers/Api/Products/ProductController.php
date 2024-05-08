<?php

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductController extends Controller
{
    //
    private $allowedFilters;
    private $fields;
    //
    public function __construct()
    {
        //
        $this->allowedFilters = [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('name'),
            AllowedFilter::exact('category_id'),
            AllowedFilter::exact('subcategory_id'),
            AllowedFilter::exact('barcode'),
            AllowedFilter::exact('delivery_company'),
            'wholesale_price',
            'retail_price',
            'weight',
            'created_at'
        ];

        $this->fields = [
            'id', 'category_id', 'subcategory_id', 'name', 'image', 'barcode', 'wholesale_price',
            'retail_price', 'weight', 'delivery_company', 'created_at'
        ];
    }
    //
    public function index()
    {
        //
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters($this->allowedFilters)
            ->allowedSorts($this->fields)
            ->allowedFields($this->fields)
            ->allowedIncludes(['category', 'subcategory', 'prices'])
            ->when(request('search'), function ($query, $search) {
                return $query->whereAny([
                    'id', 'name', 'delivery_company', 'barcode',
                    'wholesale_price', 'retail_price', 'weight'
                ], 'like', "{$search}%");
            })
            ->paginate(100);
        //
        return response()->json($products, 200);
    }
}
