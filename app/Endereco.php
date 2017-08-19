<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
	public $timestamps = false;
	protected $table = "endereco";
	protected $fillable = ['id','logradouro','numero','bairro'];
}
