<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name, '-');
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name, '-');
        });

    }

    // Use 'slug' for route binding instead of 'id'
    public function getRouteKeyName()
    {
        return 'slug';
    }

    private static function generateUniqueSlug($name, $id = 0)
    {
        $slug = Str::slug($name, '-');
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }
}
