<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ClientRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title', 'description', 'price', 'deadline', 'city', 'status', 'phone'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            $client->user_id = auth()->user()->id;
        });

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
