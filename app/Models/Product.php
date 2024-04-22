<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['updated_at'];


    public function getImageAttribute($value)
    {
        if (!empty($value) && file_exists('storage/products/' . $value)) {
            return asset('storage/products/' . $value);
        }
        return asset('storage/404.png');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany(PriceProductState::class, 'product_id', 'id');
    }
}
