<?php

namespace App\Http\Controllers\Api\Categories;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class CategoryController extends Controller
{
    private $allowedFilters;
    private $fields;

    //
    public function __construct()
    {
        //
        $this->allowedFilters = [AllowedFilter::exact('id'), 'name', 'created_at'];
        $this->fields = ['id', 'name', 'image', 'created_at'];
    }
    //
    public function index()
    {
        //
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters($this->allowedFilters)
            ->allowedSorts($this->fields)
            ->allowedFields($this->fields)
            ->allowedIncludes(['subcategories', 'products'])
            ->paginate(100);
        //
        return response()->json($categories, 200);
    }
}
