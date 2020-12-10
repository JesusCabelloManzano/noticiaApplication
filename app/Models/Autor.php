<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    
    protected $table = 'autor';
    
    protected $fillable = ['nombre'];
    
    public function noticias() {
        return $this->hasMany('App\Models\Noticia', 'idnoticia');
    }
}
