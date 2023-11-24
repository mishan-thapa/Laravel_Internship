<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','image','user_id','status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);//, 'foreign_key', 'other_key' ,'user_id','id'
    }
}
