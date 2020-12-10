<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    
    protected $table = 'noticia';
    
    protected $fillable = ['titulo', 'texto', 'imagen', 'idautor', 'fecha'];
    
    //protected $hidden = ['imagen'];
    
    public function enterprise() {
        return $this->belongsTo('App\Models\Autor', 'idautor');
    }
}
