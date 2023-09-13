<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUe extends Model
{
    use HasFactory;
    protected $fillable = ['table_ue_id','classe_id','module_id'];

    public function table_ue_id()
    {
        return $this->belongsTo(TableUe::class, 'table_ue_id');
    }
    public function classe_id()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function module_id()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
