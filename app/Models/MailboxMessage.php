<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailboxMessage extends Model
{
    protected $fillable = [
        'title',
        'body',
        'sender',
        'recipient',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
