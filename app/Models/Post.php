<?php

namespace App\Models;

use Endropie\ApiToolkit\Traits\HasFilterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasFilterable;

    protected $fillable = ['title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = $model->user_id ?: auth()->user()->id;
            return $model;
        });
    }
}
