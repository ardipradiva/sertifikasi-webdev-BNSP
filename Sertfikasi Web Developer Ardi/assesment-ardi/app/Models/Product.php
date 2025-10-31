<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail', 'category', 'product', 'harga',
    ];

    // Backwards-compatible accessors so templates using english names still work
    public function getPriceAttribute()
    {
        return $this->attributes['harga'] ?? null;
    }

    public function getProductNameAttribute()
    {
        return $this->attributes['product'] ?? null;
    }
}
