<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification_id',
        'school',
        'subject_id',
        'major_core_id',
        'year_of_passing',
        'certificate',
        'division',
        'course_duration',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function majorCore()
    {
        return $this->belongsTo(MajorCore::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'user_district_id');
    }
}
