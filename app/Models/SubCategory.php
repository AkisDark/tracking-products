<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $guarded = ['id'];

    protected $hidden = ['updated_at'];

    public function getImageAttribute($value)
    {
        if (!empty($value) && file_exists('storage/subcategories/' . $value)) {
            return asset('storage/subcategories/' . $value);
        }
        return asset('storage/404.png');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }
}
