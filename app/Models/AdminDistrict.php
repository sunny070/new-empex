<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDistrict extends Model
{
    use HasFactory;


    // protected $appends = ['jurisdiction'];

    public function district()
    {
        return $this->belongsToMany(District::class, 'admin_districts');
    }
    // public function getJurisdictionAttribute()
    // {
    //     return $this->district()->get();
    // }
}
