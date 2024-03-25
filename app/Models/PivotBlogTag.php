<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PivotBlogTag extends Model
{
    use HasFactory;

    protected $table = 'pivot_blog_tag';

    protected $fillable = [
        'blog_id',
        'tag_id'
    ];

    // public function blogs(): BelongsToMany
    // {
    //     return $this->belongsToMany(Blog::class);
    // }

    // public function tags(): BelongsToMany
    // {
    //     return $this->belongsToMany(Tag::class);
    // }
}
