<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['titre', 'body', 'image', 'profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
