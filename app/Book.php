<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'user_id_fk'
    ];

    public function userRelation(){

         return $this->belongsTo(User::class, 'user_id_fk','id');
    }
}
