<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCode extends Model
{
    protected $table = 'package_codes';

    protected $fillable = [
        'company_id',
        'code',
        'type',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        // add any other fields you have in your table
    ];

    /**
     * Get the company that owns the package code.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'packagecode_id');
    }
}