<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'description',
        'old_price',
        'new_price',
        'is_active'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }
    
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = static::generateUniqueSlug($product->name);
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

    private static function generateUniqueSlug(string $name, $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $count = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $slug . '-' . $count++;
        }
        
        return $slug;
    }

    // Accessor for formatted prices
    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? '৳' . number_format($this->old_price, 2) : null;
    }

    public function getFormattedNewPriceAttribute()
    {
        return '৳' . number_format($this->new_price, 2);
    }

}
