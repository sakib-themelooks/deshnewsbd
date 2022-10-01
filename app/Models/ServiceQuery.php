<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQuery extends Model
{
    use HasFactory;

    public function get_service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
}
