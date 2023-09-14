<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'country_id'
    ];

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function books():BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    } 
}
