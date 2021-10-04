<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cad_turmas extends Model
{
    use HasFactory;
    protected $fillable = [
        'ano','nivel','serie','turno'
    ];
}
