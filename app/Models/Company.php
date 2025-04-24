<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Company extends Authenticatable
{
    use Notifiable;

    protected $table = 'companies';

    protected $fillable = [
        'name', 'email', 'password', 'description', 'package_code',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function packageCodes()
    {
        return $this->hasMany(PackageCode::class, 'company_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'company_id');
    }
}