<?php

namespace App\Models;

use App\Models\Author;// no need because of namespace
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'countries';

    protected $fillable = [
        'name',
    ];

    public function authors():HasMany
    {
        return $this->hasMany(Author::class);
    }
}
