<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UltimoUpdate extends Model
{
    use HasFactory;

    protected $table = 'ultimo_update';

    protected $fillable = [
        'nome_cliente',
        'documento'
    ];
}
