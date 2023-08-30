<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'title',
        'description',
        'file',
        'logo',
        'no_of_posts',
        'due_date_of_submission',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($post) {
            $post->slug = $post->generateSlug($post->title);
            $post->save();
        });

    }

    private function generateSlug($title)
    {
        $slug = Str::slug($title);

        // check to see if any other slugs exist that are the same & count them
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        // if other slugs exist that are the same, append the count to the slug
        $slug = $count ? "{$slug}-{$count}" : $slug;
        return $slug;
    }


    // protected $with = [
    //   'department',
    // ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function attachments()
    {
        return $this->hasMany(JobFile::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
