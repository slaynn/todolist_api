<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;



class Todo  extends Model
{
    
    protected $fillable = [
        'name',
        'completed',
        'todolist_id'
    ];

    public function todolist(){
        return $this->belongsTo('App\Models\Todolist');
    }
}
