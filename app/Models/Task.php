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
	
	
	protected $appends = ['date_time', 'task_user_name', 'task_client_name'];  //,


    // rozšírenie cez Eloquent Accessors
    public function getDateTimeAttribute()
    {
        return date('d-m-Y', strtotime($this->created_at));
    }

    public function getTaskUserNameAttribute()
    {
        return $this->User->name;
    }

    public function getTaskClientNameAttribute()
    {
        return $this->client->Company;
    }
	
	
	// priradenie vztahov
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
