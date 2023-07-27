<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    // protected $fillable = ['name',
    // 'url',
    // 'stripe_id',
    // 'plan_type_id',
    // 'price',
    // 'recomended',
    // 'description'];

    public function features(){
        return $this->hasMany(Feature::class);
    }
    public function typePlan(){
        return $this->belongsTo(TypePlan::class, 'plan_type_id');
    }

    public function getPriceFormatted(){
        return number_format($this->price, 2, ',', '.');
    }
}
