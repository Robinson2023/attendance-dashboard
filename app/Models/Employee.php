<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

protected $fillable = [
    'first_name','last_name','document_type','document_number',
    'birth_date','birth_place','gender','marital_status','address',
    'phone','email','photo','position','department','schedule',
    'internal_card_number','contract_type','hire_date','termination_date',
    'salary','eps','pension_fund','cesantias_fund','arl','compensation_fund',
    'cotizante_type','emergency_contact_name','emergency_contact_relationship',
    'emergency_contact_phone','bank','account_number','shirt_size',
    'pants_size','shoe_size','account_type','training_certificates'
];

public function contract()
{
    return $this->hasOne(Contract::class);
}
}
