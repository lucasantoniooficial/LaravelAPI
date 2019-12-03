<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['user_id', 'nome'];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }
}
