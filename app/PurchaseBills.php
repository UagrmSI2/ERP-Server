<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseBills extends Model
{
    protected $fillable = ['nombre', 'fecha', 'monto', 'purchase_note_id'];
}
