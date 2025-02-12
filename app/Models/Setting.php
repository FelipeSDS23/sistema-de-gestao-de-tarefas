<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
        'user_id',
        'send_email_on_create',
        'send_email_on_edit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
