<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcoFamily extends Model
{
  use HasFactory;

  public function detail()
  {
    return $this->hasMany(NcoDetail::class);
  }

  public function group()
  {
    return $this->belongsTo(NcoGroup::class, 'nco_group_id');
  }

  public function ncoDetail()
  {
    return $this->hasMany(NcoDetail::class);
  }

  public function job_nco()
  {
    return $this->hasMany(JobNco::class);
  }
}
