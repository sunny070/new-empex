<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteringAuthority extends Model
{
    use HasFactory;

    public function district()
    {
        return $this->belongsToMany(District::class, 'registering_authority_districts');
    }
}
