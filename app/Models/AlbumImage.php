<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumImage extends BaseModel
{
    protected $table = 'album_images';
    protected $fillable = [
        'album_id',
        'url',
        'title',
        'subtitle',
        'created_by',
        'updated_by',
    ];
    public function album(): BelongsTo
    {
     return  $this->belongsTo(Album::class);
    }
    public function creator(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'created_by');
    }
    public function updater(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'updated_by');
    }
}
