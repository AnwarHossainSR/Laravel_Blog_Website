<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'category_id',
        'admin_id',
        'status',
    ];
    protected $appends = 'url';

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function clearMediaCollection(string $colectionName='default'): HasMedia
    {

    }
    public function getUrlAttribute()
    {
        $hasMedia = $this->getMedia('feature_image')->first();
        return $hasMedia != null ? $hasMedia->getUrl() : '';
    }
}
