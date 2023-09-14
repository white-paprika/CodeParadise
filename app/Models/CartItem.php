<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'cart_items';

    protected $fillable = ['quantity'];

    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function cart():BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
