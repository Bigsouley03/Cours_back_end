<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['className', 'status','etudiant_id'];

    public function etudiant_id()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

}
