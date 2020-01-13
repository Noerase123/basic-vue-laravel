<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = "tbl_student";
    protected $primaryKey = "student_id";
    protected $fillable = ['name', 'age', 'studentYear', 'course'];
}
