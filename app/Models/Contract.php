<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'salary',
        'position',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

