<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingItem extends Model
{

    protected $fillable = ['user_id', 'ingredient_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
