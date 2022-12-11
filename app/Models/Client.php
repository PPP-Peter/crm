<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Client extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable =  [  // povolene hodnoty pre ulozenie
        'Company', 'Address', 'VAT' , 'created_at',
    ];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
	
	
	//Mutators
    public function setCompanyAttribute($value)
    {
        $this->attributes['Company'] = ucfirst($value);   
    }
    public function setAddressAttribute($value)
    {
        $this->attributes['Address'] = ucfirst($value);  
    }

}
