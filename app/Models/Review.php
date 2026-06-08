<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends BaseModel
{
    protected $table = 'reviews';
    protected $fillable = [
        'author',
        'author_image_url',
        'author_phone_number',
        'published',
        'date',
        'text',
        'attachment_url',
        'created_by',
        'updated_by',
    ];
    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updater():BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    protected $casts = [
        'date' => 'date',
    ];

}
