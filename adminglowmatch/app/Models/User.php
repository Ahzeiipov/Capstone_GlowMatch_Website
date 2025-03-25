<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'UserID';
    protected $fillable = ['UserName', 'Email', 'password'];
    public $timestamps = false;

    public function product()
    {
        return $this->hasMany(Product::class, 'UserID', 'UserID');
    }
}