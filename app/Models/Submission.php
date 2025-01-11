<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'umkm_name',
        'establishment_date',
        'business_type',
        'description',
        'application_letter',
        'rab_document',
        'status',
        'admin_notes'
    ];

    // Add created_at and updated_at to $dates array
    protected $dates = [
        'establishment_date',
        'created_at',
        'updated_at'
    ];

    // Or use $casts for more specific type casting
    protected $casts = [
        'establishment_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUmkmAgeAttribute()
    {
        $establishment = Carbon::parse($this->establishment_date);
        $now = Carbon::now();

        $years = intval($establishment->diffInYears($now));
        $months = intval($establishment->diffInMonths($now) % 12);
        $weeks = intval(floor($establishment->diffInDays($now) / 7));
        $days = intval($establishment->diffInDays($now) % 7);

        if ($years > 0) {
            return $years . ($years == 1 ? ' Year' : ' Years');
        }

        if ($months > 0) {
            return $months . ($months == 1 ? ' Month' : ' Months');
        }

        if ($weeks > 0) {
            return $weeks . ($weeks == 1 ? ' Week' : ' Weeks');
        }

        return 'Less than 1 Week';
    }
}
