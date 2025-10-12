<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealExpense extends Model
{
    protected $fillable = [
        'project_id',
        'description',
        'cost',
        'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
