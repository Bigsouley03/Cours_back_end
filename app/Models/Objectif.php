<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;
    protected $fillable = ['description','cours_enroller_id','etat'];

    public function cours_enroller_id()
    {
        return $this->belongsTo(CoursEnroller::class, 'cours_enroller_id');
    }
}
