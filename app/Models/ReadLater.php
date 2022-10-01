<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadLater extends Model
{
    protected $guarded = [];

    public function news(){
        return $this->belongsTo(News::class);
    }
}
