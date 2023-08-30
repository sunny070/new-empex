<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class, 'sponsorship_users');
    }

    public function qualification()
    {
        return $this->belongsToMany(Qualification::class, 'sponsorship_qualifications');
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class, 'sponsorship_subjects');
    }

    public function major_core()
    {
        return $this->belongsToMany(MajorCore::class, 'sponsorship_major_cores');
    }
}
