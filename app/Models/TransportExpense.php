<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportExpense extends Model
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

