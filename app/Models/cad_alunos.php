<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cad_alunos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome','telefone','email','data_nascimento','genero'
    ];
}
