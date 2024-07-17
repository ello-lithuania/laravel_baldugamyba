<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Models\Gallery;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','city','upgrade','description','phone','email','website'];

    protected function casts(): array
    {
        return [
            'upgrade' => 'date',
        ];

    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($provider) {
            $provider->slug = Str::slug($provider->title, '-');
        });

        static::updating(function ($provider) {
            $provider->slug = Str::slug($provider->title, '-');
        });
        static::saving(function ($provider) {
            $provider->slug = Str::slug($provider->title, '-');
        });
    }

    // Use 'slug' for route binding instead of 'id'
    public function getRouteKeyName()
    {
        return 'slug';
    }

    private static function generateUniqueSlug($title, $id = 0)
    {
        $slug = Str::slug($title, '-');
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories():belongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    public function getDescriptionExcerptAttribute()
    {
        return $this->createExcerpt($this->description, 20);
    }
    protected function createExcerpt($string, $wordLimit)
    {
        $words = explode(' ', $string);
        if (count($words) > $wordLimit) {
            return implode(' ', array_slice($words, 0, $wordLimit)) . '...';
        }
        return $string;
    }
}
