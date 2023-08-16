<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilterSearch($query, array $filters){

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        })
            ->when($filters['category'] ?? false, function ($query, $category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            })
            ->when($filters['author'] ?? false, function ($query, $user) {
                $query->whereHas('user', function ($query) use ($user) {
                    $query->where('user_name', $user);
                });
            });

        return $query->orderBy('created_at', 'desc');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
