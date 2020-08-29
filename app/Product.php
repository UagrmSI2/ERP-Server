<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['descripcion','nombre','precio','costo','category_id'];
}
