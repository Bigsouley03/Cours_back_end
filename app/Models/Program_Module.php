<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_module extends Model
{
    use HasFactory;

    protected $fillable = ['table_ue_id','classe_id'];

    public function table_ue()
    {
        return $this->belongsTo(TableUe::class, 'table_ue_id');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'program_ue_modules', 'program_module_id', 'module_id');
    }
}
