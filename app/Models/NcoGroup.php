<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcoGroup extends Model
{
  use HasFactory;

  public function family()
  {
    return $this->hasMany(NcoFamily::class);
  }

  public function subdivision()
  {
    return $this->belongsTo(NcoSubDivision::class, 'nco_sub_division_id');
  }

  public function division()
  {
    return $this->belongsTo(NcoDivision::class, 'nco_division_id');
  }
}
