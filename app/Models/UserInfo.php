<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'user_id', 'profile_pic', 'full_name', 'email', 'phone_number', 'bio'
    ];

    // Define relationship with User (assuming you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
