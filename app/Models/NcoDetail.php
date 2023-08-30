<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcoDetail extends Model
{
    use HasFactory;

    public function family()
    {
        return $this->belongsTo(NcoFamily::class, 'nco_family_id');
    }
}
