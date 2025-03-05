<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteRecipe extends Model
{
  
    protected $fillable=['recipe_id','user_id'];

}
