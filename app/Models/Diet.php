<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    
    protected $fillable = ['name'];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'diet_id');
    }
}
