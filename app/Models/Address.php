<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'state_id',
    'district_id',
    'village',
    'rd_block_id',
    'police_station_id',
    'pin_code',
    'post_office_id',
    'house_no',
    'same_as_permanent',
    'type',
  ];

  // protected $with = [
  //   'state',
  //   'district',
  //   'village',
  //   'rdBlock',
  //   'policeStation',
  //   'postOffice',
  //   'pinCode',
  // ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function state()
  {
    return $this->belongsTo(State::class);
  }

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
