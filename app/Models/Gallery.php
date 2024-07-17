<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GalleryImage;
use App\Models\Provider;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['provider_id','title', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->provider_id = auth()->user()->provider_profile->id;
        });

    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
