<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcoSubDivision extends Model
{
  use HasFactory;

  public function group()
  {
    return $this->hasMany(NcoGroup::class);
  }

  public function division()
  {
    return $this->belongsTo(NcoDivision::class, 'nco_division_id');
  }
}
