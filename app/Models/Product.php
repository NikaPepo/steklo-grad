<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Product extends BaseModel
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'image_url',
        'description',
        'meta_title',
        'meta_description',
        'meta_image',
        'created_by',
        'updated_by',
    ];
public function category(): BelongsTo
{
    return $this->belongsTo(Category::class, 'category_id');
}
public function creator(): BelongsTo
{
    return $this->belongsTo(User::class, 'created_by');
}
public function updater(): BelongsTo
{
    return $this->belongsTo(User::class, 'updated_by');
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
