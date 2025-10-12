<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'quantity',
        'unit_cost',
        'total_cost',
    ];

    // 🔗 Relación con proyectos
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // 📊 Calcula automáticamente el costo total si no se define
    protected static function booted()
    {
        static::saving(function ($material) {
            $material->total_cost = $material->quantity * $material->unit_cost;
        });
    }

}
