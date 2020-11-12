<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $table='Books';
    protected $fillable=['user_id','name_writer','name_book','image','year_printbook',
        'price_book','categore_id','view_book'];
    public function Categore(){
        return $this->belongsTo(Categore::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function users(){
        return $this->belongsToMany(User::class,'book_user');
    }
    public function like_users(){
        return $this->belongsToMany(User::class,'book_user_like')->withTimestamps();
    }
}
