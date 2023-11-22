<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'stock' => 'integer',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('/images/product/' . $value);
        } else {
            return url('/images/product/default.jpg');
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
