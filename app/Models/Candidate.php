<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
     protected $fillable = [
        'owner_id',
        'first_name',
        'last_name',
        'age',
        'department',
        'min_salary_expectation',
        'max_salary_expectation',
        'currency_id',
        'address_id',
    ];
      public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
     public function education()
    {
        return $this->hasMany(Education::class);
    }
       public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
  

}
