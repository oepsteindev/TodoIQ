<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Todos extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'todolist_collection';
    
    protected $fillable = [
        'title', 'completed', 'created_at'
    ];
}


