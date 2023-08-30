<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
  use Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'role_id',
    'department_id',
    'district_id',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime'
  ];

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function district()
  {
    return $this->belongsToMany(District::class, 'admin_districts');
  }

  public function role()
  {
    return $this->belongsTo(Role::class);
  }

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function organization()
  {
    return $this->hasOne(Organization::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function address()
  {
    return $this->hasOne(OrganizationAddress::class);
  }
}
