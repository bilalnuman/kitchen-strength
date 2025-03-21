<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDay extends Model
{
    protected $fillable = ['plan_id', 'title'];


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'plan_day_recipe', 'plan_day_id', 'recipe_id')
            ->withTimestamps()->withPivot('id');
    }
}
