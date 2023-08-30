<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationQualification extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'qualification_id',
    'school',
    'subject_id',
    'major_core_id',
    'year_of_passing',
    'certificate',
    'division',
    'course_duration',
  ];

  // protected $with = [
  //   'qualification',
  //   'subject',
  //   'majorCore',
  // ];

  public function qualification()
  {
    return $this->belongsTo(Qualification::class);
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function majorCore()
  {
    return $this->belongsTo(MajorCore::class);
  }
}
