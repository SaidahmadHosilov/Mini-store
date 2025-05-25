<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'status'];

    /**
     * Get the product associated with the basket.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who owns the basket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
