<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeNco extends Model
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
}
