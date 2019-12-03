<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['user_id', 'categoria_id', 'nome','marca','preco'];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function categoria()
    {
        return $this->hasOne(\App\Categoria::class, 'id','categoria_id');
    }
}
