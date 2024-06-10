<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $c = 1;
        while (Type::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . '-' . $c;
            $c++;
        }
        return $slug;
    }
}
