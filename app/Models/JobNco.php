<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobNco extends Model
{
    use HasFactory;

    public function detail()
    {
        return $this->belongsTo(NcoDetail::class, 'nco_detail_id');
    }
}
