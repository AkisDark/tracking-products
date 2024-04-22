<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceProductState extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['updated_at'];

    public function product()
    {

        return $this->belongsTo(Product::class);
    }

    public function state()
    {

        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
