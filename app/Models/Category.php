<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    // use Sluggable;

    protected $fillable = ['name', 'description', 'priority'];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
    /**
     * @return array
     */
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'slug';
    }
}
