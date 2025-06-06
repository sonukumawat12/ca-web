<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'tags',
        'is_published',
        'published_at',
        'scheduled_at'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime:Y-m-d H:i:s',
        'scheduled_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
