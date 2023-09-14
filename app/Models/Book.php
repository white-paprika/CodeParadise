<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'name',
        'description',
        'price',
        'path',
        'items_in_stock',
        'release_year',
        'translator',
        'genre_id',
    ];

    public function authors():BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function sales():HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function genre():BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
                                                    //here scope takes "price_range" array (from filter) as ...$prices
    public function scopePriceRange(Builder $query, ...$prices): Builder
    {   
        return $query->whereBetween('price', $prices);
    }
    /**
     * scope takes a query builder (from previous filtering) and a ...$genres array, which represents an "genres" array from a request, filter handles 
     * scope returns a query builder
     * 
     * scope adds to query new conditions:
     * whereHas takes model relation (genre() method) and closure
     * 
     * $q, which represents an instance of the query builder for the relationship
     * 
     * By using the "use" keyword, it includes the $genres variable from the outer scope into the closure, allowing it to be used within the closure.
     * 
     *  $q->whereIn('name', $genres); Takes Genre::class'es instances which contain one of $genres array's items in their 'name' field
     * 
     * After this whereHas adds to $query next condition:
     * It has to contain rows which have in their genre() method only genres which were retrieved within closure
     * 
     * In other words whereHas calls to Model's genre() method accepts only $query instances which have at list one genre
     * By closure we specify it to accept only instances with only genres which have any of selected names ($genres array) 
     */
    public function scopeSelectedGenres(Builder $query, ...$genres): Builder 
    {          
        return $query->whereHas('genre', function($q) use ($genres){
            $q->whereIn('name', $genres);
        });
    }

    public function reduceItemsInStock($quantity):void
    {
        $this->items_in_stock = $this->items_in_stock - $quantity;
    }
}
