<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    //
    protected $fillable = ['title', 'status', 'category', 'deadline'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
