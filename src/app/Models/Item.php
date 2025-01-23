<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'condition_id', 'brand', 'price', 'description', 'is_purchased', 'user_id'];
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasLikedBy($user): bool
    {
        return Favorite::where('user_id', $user->id)->where('item_id', $this->id)->first() != null;
    }
}
