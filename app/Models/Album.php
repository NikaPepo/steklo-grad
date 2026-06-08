<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Album extends BaseModel
{

    protected $table = 'albums';
    protected $fillable = [
        'name',
        'slug',
        'thumbnail_url',
        'video_url',
        'is_visible',
        'is_video',
        'created_by',
        'updated_by',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(AlbumImage::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function booted()
    {
        static::deleting(function (Album $album) {
            $albumImages = $album->images()->get();
            foreach ($albumImages as $albumImage) {
                if ($albumImage->url) {
                    Storage::disk('public')->delete($albumImage->url);
                }
            }
        });
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
