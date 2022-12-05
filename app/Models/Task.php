<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =  [  // povolene hodnoty pre ulozenie
        'title', 'user_id', 'project_id', 'client_id', 'description', 'status' , 'created_at', 'priority'
    ];

    public function Client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function Project()
    {
        return $this->belongsTo('App\Models\Project');
    }

}
