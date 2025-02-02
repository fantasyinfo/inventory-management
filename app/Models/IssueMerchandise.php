<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueMerchandise extends Model
{

    protected $table = 'issue_merchandise';
    protected $fillable = [
        'employee_id',
        'merchandise_id',
        'issued_by',
        'qty',
        'issue_date',
        'remarks',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class, 'merchandise_id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

}
