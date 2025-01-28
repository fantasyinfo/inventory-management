<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //


    protected $table = 'employees';
    protected $fillable = [
        'emp_id',
        'department',
        'full_name',
        'company_contractor',
        'category',
        'date_of_joining',
        'plant_location',
    ];

}

