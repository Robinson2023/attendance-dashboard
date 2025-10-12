<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'client', 'price', 'start_date', 'end_date'];

    // Relación muchos a muchos con empleados
    public function employees()
    {
        return $this->belongsToMany(Employee::class)
                    ->withPivot('assigned_at')
                    ->withTimestamps();
    }

    // Relación con registros de trabajo
public function workLogs()
{
    return $this->hasMany(WorkLog::class);
}

    // Relación con reportes del proyecto
    public function reports()
    {
        return $this->hasMany(ProjectReport::class);
    }

public function materials()
{
    return $this->hasMany(Material::class);
}

public function transports()
{
    return $this->hasMany(TransportExpense::class);
}

public function meals()
{
    return $this->hasMany(MealExpense::class);
}

}

