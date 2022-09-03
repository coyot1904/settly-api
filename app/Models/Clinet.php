<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinet extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'email' , 'profile_picture' , 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
