<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'comments';    

    protected $fillable = [
        'rating',
        'content',
    ];

    
    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
