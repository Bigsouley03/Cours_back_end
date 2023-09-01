<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'adresse', 'specialite', 'user_id'];

    // Relation avec le modèle User
    public function user_id()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
