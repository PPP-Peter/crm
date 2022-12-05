<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =  [  // povolene hodnoty pre ulozenie
        'Company', 'Address', 'VAT' , 'created_at'
    ];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

}
