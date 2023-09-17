<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableUe extends Model
{
    use HasFactory;
    protected $fillable = ['nomUe','classe_id'];

    public function classe_id()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
