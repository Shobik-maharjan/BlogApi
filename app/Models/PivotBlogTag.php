<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotBlogTag extends Model
{
    use HasFactory;

    protected $table = 'pivot_blog_tag';

    protected $fillable = [
        'blog_id',
        'tag_id'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,);
    }
}
