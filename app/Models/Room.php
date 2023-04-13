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

    public function messages()
    {
        return $this->hasMany(Message::class);
    } // end of messages
}
