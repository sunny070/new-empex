<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'mobile_no'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];

  // protected $with = [
  //   'basicInfo',
  //   'address',
  //   'educationQualification',
  //   'experience',
  //   'userCanRead',
  //   'userCanWrite',
  //   'userCanSpeak',
  // ];

  public function basicInfo()
  {
    return $this->hasOne(BasicInfo::class);
  }

  public function address()
  {
    return $this->hasMany(Address::class);
  }


  public function getAddr()
  {
    return $this->address()->first() ? $this->address()->first()->district->district_code : '00';
  }



  public function educationQualification()
  {
    return $this->hasMany(EducationQualification::class);
  }

  public function experience()
  {
    return $this->hasMany(Experience::class);
  }

  public function userCanRead()
  {
    return $this->hasMany(UserCanRead::class);
  }

  public function userCanWrite()
  {
    return $this->hasMany(UserCanWrite::class);
  }

  public function userCanSpeak()
  {
    return $this->hasMany(UserCanSpeak::class);
  }
}
