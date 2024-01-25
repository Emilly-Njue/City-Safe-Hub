<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCrimes extends Model
{
    use HasFactory;

    protected $table = 'report_crimes';

    protected $fillable = [
        'email',
        'role',
        'gender',
        'crime_type',
        'description',
        'location',
        'random_code',
        'status', 
        'assigned_officer',
    ];

    public function officers()
    {
        return $this->belongsTo(Officers::class);
    }
}
