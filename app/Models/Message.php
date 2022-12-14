<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable =  [  // povolene hodnoty pre ulozenie
      'user_id', 'message', 'created_at'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

}
