<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
	public $timestamps = false;
	protected $table = "nota";
	protected $fillable = ['id','valor','aluno_id'];
}
