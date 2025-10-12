<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MobileAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','type','fecha','hora','latitud','longitud'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}