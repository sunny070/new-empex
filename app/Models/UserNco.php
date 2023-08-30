<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNco extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'division_id',
        'sub_division_id',
        'group_id',
        'family_id',
        'detail_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function family()
    {
        return $this->belongsTo(NcoFamily::class);
    }

    public function detail()
    {
        return $this->belongsTo(NcoDetail::class);
    }
}
