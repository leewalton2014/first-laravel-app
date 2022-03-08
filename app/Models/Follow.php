<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
