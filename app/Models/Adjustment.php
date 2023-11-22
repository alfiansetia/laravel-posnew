<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNumberAttribute($value)
    {
        return date('y', strtotime($this->date)) . date('m', strtotime($this->date)) . date('d', strtotime($this->date)) . str_pad($value, 2, 0, STR_PAD_LEFT);
    }
}
