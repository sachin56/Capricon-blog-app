<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    
    protected $dates = [
        'published_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(user::class,'user_id','id');
    }

    public function category(){

        return $this->belongsTo(category::class, 'category_id', 'id');

    }
}
