<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apparel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'color',
        'quantity',
        'price',
        'date',
        'remarks',
        'attachment',
        'apparel_category_id',
        'apparel_type_id',
        'apparel_style_id',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apparelCategory()
    {
        return $this->belongsTo(ApparelCategory::class);
    }
    public function apparelStyle()
    {
        return $this->belongsTo(ApparelStyle::class);
    }
    public function apparelType()
    {
        return $this->belongsTo(ApparelType::class);
    }

    public function getDate($value){
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function getDateMonth($value){
        return Carbon::parse($value)->format('F d');
    }
   
}
