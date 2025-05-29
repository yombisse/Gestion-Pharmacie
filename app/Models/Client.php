<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'telephone',
        'adresse',
        'photo'
    ];

    // Relation vers User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


