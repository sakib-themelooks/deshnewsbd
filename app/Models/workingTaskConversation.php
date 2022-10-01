<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingTaskConversation extends Model
{
    use HasFactory;

    public function conversationUser(){
        return $this->belongsTo(User::class, 'from_user');
    }
}
