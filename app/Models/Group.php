<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'user_id',
        'group_name',
        'status',
    ];

    public function users()
    {
       return $this->belongsToMany(User::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }
}
