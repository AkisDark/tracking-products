<?php

namespace App\Http\Controllers\Api\Subcategories;

use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class SubcategoryController extends Controller
{
    //
    private $allowedFilters;
    private $fields;

    public function __construct()
    {
        //
        $this->allowedFilters = [AllowedFilter::exact('id'), AllowedFilter::exact('category_id'), 'name', 'created_at'];
        $this->fields = ['id', 'category_id', 'name', 'image', 'created_at'];
    }
    //
    public function index()
    {
        //
        $subcategories = QueryBuilder::for(SubCategory::class)
            ->allowedFilters($this->allowedFilters)
            ->allowedSorts($this->fields)
            ->allowedFields($this->fields)
            ->allowedIncludes(['category', 'products'])
            ->paginate(100);
        //
        return response()->json($subcategories, 200);
    }
}
