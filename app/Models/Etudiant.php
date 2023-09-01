<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // Relation avec le modèle User
    public function user_id()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // Relation avec le modèle Classe (ajustez le nom du modèle en fonction de votre cas)

}
