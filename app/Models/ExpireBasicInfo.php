<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpireBasicInfo extends Model
{
    use HasFactory;


    public function basicInfo()
    {
        return $this->belongsTo(BasicInfo::class,'basic_info_id','id');
    }
}
