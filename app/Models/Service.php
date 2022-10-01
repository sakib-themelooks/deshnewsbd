<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function ServiceType(){
        return $this->belongsTo(ServiceType::class, 'service_id');
    }
}
