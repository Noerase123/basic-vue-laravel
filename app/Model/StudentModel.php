<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = "student_models";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'age', 'studentYear', 'course'];
}
