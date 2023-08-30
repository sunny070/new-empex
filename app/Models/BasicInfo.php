<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'avatar',
    'full_name',
    'dob',
    'gender',
    'phone_no',
    'parents_name',
    'religion',
    'caste',
    'marital_status',
    'aadhar_no',
    'physically_challenge',
    'canEdit',
    'district_id',
    'card_valid_till',
    'employment_no',
    'card_valid_from',
    'card_valid_till',
    'society',
  ];

  protected $dates = ['card_valid_from','card_valid_till'];





  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function expireBasicInfo()
  {
    return $this->hasMany(ExpireBasicInfo::class,'basic_info_id','id');
  }

  public function religion()
  {
    return $this->belongsTo(Religion::class);
  }

  public function district()
  {
    return $this->belongsTo(District::class);
  }

  public function latest_education()
  {
    return $this->belongsTo(EducationQualification::class, 'user_id', 'user_id')->latest();
  }

  public function education()
  {
    return $this->hasMany(EducationQualification::class, 'user_id', 'user_id');
  }

  public function permanent_address()
  {
    return $this->belongsTo(Address::class, 'user_id', 'user_id')->where('type', 'permanent');
  }


}
