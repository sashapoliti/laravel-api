<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'slug',
        'type_id'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }

    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $c = 1;
        while (Project::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . '-' . $c;
            $c++;
        }
        return $slug;
    }
}
