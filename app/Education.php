<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table='Educations';
    protected $fillable=['name'];
    public  function user(){
        return $this->belongsTo(User::class);
    }
}
