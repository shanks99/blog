<?php

namespace App\Models;

use App\Models\BoardReply;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id","title","content"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function board_replys() : HasMany
    {
        return $this->hasMany(BoardReply::class);
    }
}
