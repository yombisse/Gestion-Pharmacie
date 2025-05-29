<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'telephone',
        'adresse',
        'poste',
        'salaire',
        'date_emploi',
        'photo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->date_emploi = now(); // auto-définie
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

