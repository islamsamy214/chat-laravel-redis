<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'users_ids'
    ]; // end of fillable

    public function messages()
    {
        return $this->hasMany(Message::class);
    } // end of messages

    public function users()
    {
        return $this->belongsToMany(User::class, 'messages', 'room_id', 'user_id')->withPivot('message');
    } // end of users
}
