<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deshjure extends Model
{
    protected $guarded = [];



    public function deshjureType()
    {
       return $this->belongsTo(Deshjure::class, 'parent_id');
    } 

    public function subLocations()
    {
       return $this->hasMany(Deshjure::class, 'parent_id');
    }

}
