<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
        'status',
    ];


    protected $dates = ['deleted_at'];

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }

}
