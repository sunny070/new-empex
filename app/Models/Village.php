<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
  use HasFactory;

  protected $fillable = [
    'district_id',
    'police_station_id',
    'rd_block_id',
    'post_office_id',
    'name',
  ];

  protected $with = [
    'rdBlock',
    'policeStation',
    'postOffice',
  ];

  public function district()
  {
    return $this->belongsTo(District::class);
  }

  public function rdBlock()
  {
    return $this->belongsTo(RdBlock::class);
  }

  public function policeStation()
  {
    return $this->belongsTo(PoliceStation::class);
  }

  public function postOffice()
  {
    return $this->belongsTo(PostOffice::class);
  }
}
