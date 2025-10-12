<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    protected $fillable = [
        'employee_id',
        'project_id',
        'date',
        'start_time',
        'end_time',
        'hours',
        'notes'
    ];

public function employee()
{
    return $this->belongsTo(Employee::class);
}

public function project()
{
    return $this->belongsTo(Project::class);
}

}
