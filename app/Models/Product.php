<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
    ];
    public function pictures()
    {   
        return $this->hasMany(Picture::class);
    }

    public function categories()
    {
        return $this->hasOne(Category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
                            
    }
}