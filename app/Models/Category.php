<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends BaseModel
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'thumbnail_url',
        'meta_title',
        'meta_description',
        'meta_image',
        'created_by',
        'updated_by',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
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
        static::deleting(function (Category $category) {
            $children = $category->children()->get();
            $products = $category->products()->get();
            foreach ($products as $product) {
                if (isset($product->image_url)) {
                    Storage::disk('public')->delete($product->image_url);
                }
                if (isset($product->meta_image) && $product->meta_image !== $product->image_url) {
                    Storage::disk('public')->delete($product->meta_image);
                }
            }
            foreach ($children as $child) {
                if (isset($child->thumbnail_url)) {
                    Storage::disk('public')->delete($child->thumbnail_url);
                }
                if (isset($child->meta_image) && $child->meta_image !== $child->thumbnail_url) {
                    Storage::disk('public')->delete($child->meta_image);
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
    public function getBreadcrumbAttribute()
    {
        $category = $this;
        $parents = collect([]);

        while ($category) {
            $parents->prepend($category);
            $category = $category->parent;
        }

        return $parents;
    }
    public function getAncestorsAttribute()
    {
        $parents = collect([]);
        $category = $this->parent;

        while ($category) {
            $parents->push($category);
            $category = $category->parent;
        }

        return $parents->reverse();
    }
    public function getFullPathAttribute()
    {
        $parts = [];
        $category = $this;

        while ($category) {
            array_unshift($parts, $category->slug);
            $category = $category->parent;
        }

        return implode('/', $parts);
    }
    public function isDescendantOf(Category $parent): bool
    {
        $current = $this;

        while ($current) {
            if ($current->id === $parent->id) {
                return true;
            }

            $current = $current->parent;
        }

        return false;
    }

}
