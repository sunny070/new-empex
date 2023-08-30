<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

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

    public function user_district()
    {
        return $this->belongsTo(District::class, 'user_district_id');
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
