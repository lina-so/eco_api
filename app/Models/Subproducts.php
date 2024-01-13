<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subproducts extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','product_id','description','name','image','price','discount_price','quantity'];

    protected $table = 'subproducts';

    


    public function colors()
    {
       return $this->belongsToMany(Color::class,'product_colors');
    }

    public function sizes()
    {
       return $this->belongsToMany(Size::class,'product_sizes');
    }

    public function users()
    {
       return $this->belongsToMany(User::class,'favoraites');
    }
}
