<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'amount',
        'date',
        'remarks',
        'attachment',
        'transaction_category_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function transactionCategory()
    {
        return $this->belongsTo(TransactionCategory::class);
    }

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
