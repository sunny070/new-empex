<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designation',
        'from',
        'to',
        'company',
        'total_emoluments',
        'leave_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'user_district_id');
    }
}
