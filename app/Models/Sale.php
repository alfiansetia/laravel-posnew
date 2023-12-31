<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sale_detail()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function getNumberAttribute($value)
    {
        return date('y', strtotime($this->date)) . date('m', strtotime($this->date)) . date('d', strtotime($this->date)) . str_pad($value, 4, 0, STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
