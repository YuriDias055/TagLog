<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = ['street', 'num', 'district', 'city', 'state', 'info'];
    public $timestamps = false;
}
