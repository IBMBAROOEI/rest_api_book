<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='books';
    protected $fillable=['user_id','name_writer','name_book','image','year_printbook',
        'price_book','categore_id','view_book'];
    public function user(){
        return $this->belongsTo(user::class);
    }
    public function users(){
        return $this->belongsToMany(user::class,'book_user');
    }
    public function like_users(){
        return $this->belongsToMany(user::class,'book_user_like')->withTimestamps();
    }
}
