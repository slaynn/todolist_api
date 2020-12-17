<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Todolist extends Model 
{
    
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function todos(){
        return $this->hasMany('App\Models\Todo');
    }
}
