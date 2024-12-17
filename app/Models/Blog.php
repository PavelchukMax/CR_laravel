<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'created_or_updated_at', 
    ];

    protected $casts = [
        'created_or_updated_at' => 'datetime',  
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($blog) {
            $blog->created_or_updated_at = now();  
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isOwnedBy($userId)
    {
        return $this->user_id == $userId;
    }
}