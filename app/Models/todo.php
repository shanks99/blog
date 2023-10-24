<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class todo extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "content"
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
