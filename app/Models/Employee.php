<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'gender', 'salary'
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
}
