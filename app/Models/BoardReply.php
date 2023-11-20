<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoardReply extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id","board_id","deep","re_sort","comment"
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
