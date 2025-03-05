<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDayRecipe extends Model
{
    protected $table='plan_day_recipe';
    protected $fillable=['plan_day_id','recipe_id'];
}
