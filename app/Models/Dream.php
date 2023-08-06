<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    use HasFactory;
    protected $fillable = [
      'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
      return $this->hasMany(Comment::class);
    }

    // public function likes(): HasMany
    // {
    //   return $this->hasMany(Like::class);
    // }

    public function likes(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'likes');
}

}
