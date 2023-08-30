<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhysicalChallenge extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'physical_challenge_id',
  ];

  public function physicalChallenge()
  {
    return $this->belongsTo(PhysicalChallenge::class);
  }
}
