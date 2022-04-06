<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'id',
        'title',
        'content',
    ];
    protected $primaryKey = 'id';

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    /**
     * The roles that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function users(): BelongsToMany
    // {
    //     Quan hệ nhiều: ('Model bẳng hướng tới', 'tên bảng trung gian', 'Khóa phụ bảng trung gian bảng ban đầu',
    //       'Khóa phụ bảng trung gian hướng tới lấy dữ liệu',)
    //     return $this->belongsToMany(User::class, 'comments', 'post_id', 'user_id');
    // }
}   
