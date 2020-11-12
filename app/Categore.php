<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categore extends Model
{
    protected $fillable=['name'];
    public function Books(){
        return $this->hasMany(Book::class);
    }

}
