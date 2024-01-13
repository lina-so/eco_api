<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoraite extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'subproducts_id', 'user_id'];

}
