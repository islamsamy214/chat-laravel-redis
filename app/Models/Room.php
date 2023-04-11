<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ]; // end of fillable

    public function users()
    {
        return $this->belongsToMany(User::class, 'messages', 'room_id', 'user_id')->withPivot('message');
    } // end of users relation
}