<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class MajorCore extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'subject_id',
  ];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }
}
