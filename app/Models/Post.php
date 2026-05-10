<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug;  // حتماً این رو داشته باش

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description'
    ];

    // متد تنظیمات slug
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')   // از عنوان می‌سازد
            ->saveSlugsTo('slug');          // در فیلد slug ذخیره می‌کند
    }
      /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}