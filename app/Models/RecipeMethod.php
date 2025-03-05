<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeMethod extends Model
{
    protected $fillable = ['instruction', 'recipe_id'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
