<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'date',
        'location',
        'type',
        'remarks',
        'attachment',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function getDate($value){
    return Carbon::parse($value)->format('Y-m-d');
}
public function getDateMonth($value){
    return Carbon::parse($value)->format('F d, Y');
}


}
