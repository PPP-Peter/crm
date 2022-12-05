<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =  [  // povolene hodnoty pre ulozenie
        'title', 'user_id', 'client_id', 'description', 'slug' , 'created_at', 'deadline', 'status'
    ];


    public function Client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

}