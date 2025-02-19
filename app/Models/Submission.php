<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'tujuan_pengajuan',
        'pendapatan_bulan',
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

}
