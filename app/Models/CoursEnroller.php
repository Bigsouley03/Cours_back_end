<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursEnroller extends Model
{
    use HasFactory;
    protected $fillable = ['objectifs', 'heureTotal','heureDeroule','heureRestant','module_id','professeur_id','classe_id','semestre_id'];


    public function module_id()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function professeur_id()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function classe_id()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
    public function semestre_id()
    {
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    public function modules()
{
    return $this->hasMany(Module::class, 'cours_enroller_id');
}



}
