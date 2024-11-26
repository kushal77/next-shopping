<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'product_id', 'tag'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
