<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJobNcs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_post_ncs_id',
    ];

    public function job()
    {
        return $this->belongsTo(JobPostNcs::class);
    }
}
