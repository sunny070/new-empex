<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcoDivision extends Model
{
  use HasFactory;

  public function subdivision()
  {
    return $this->hasMany(NcoSubDivision::class);
  }
}
