<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'company_id',
        'packagecode_id',
        'user_name',
        'email',
        'contact_no',
        'package_code',
        'nusuk_booking_no',
        'guide_name',
        'accommodation',
        'transportation',
        'meal',
        'guide_support_booking_process',
        'guide_support_hajj',
        'experience',
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

    public function packageCodes()
    {
        return $this->belongsTo(PackageCode::class, 'packagecode_id');
    }
}