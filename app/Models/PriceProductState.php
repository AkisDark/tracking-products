<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceProductState extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['updated_at', 'created_at'];

    protected $appends  = ['state_name'];

    public function product()
    {

        return $this->belongsTo(Product::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getStateNameAttribute()
    {
        return State::where('id', $this->attributes['state_id'])->value('name');
    }
}
