<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = ['gallery_id', 'file_path'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
