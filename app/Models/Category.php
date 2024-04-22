<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['updated_at'];

    public function getImageAttribute($value)
    {
        if (!empty($value) && file_exists('storage/categories/' . $value)) {
            //
            return asset('storage/categories/' . $value);
        }
        return asset('storage/404.png');
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
