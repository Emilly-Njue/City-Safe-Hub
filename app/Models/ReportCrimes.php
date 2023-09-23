<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCrimes extends Model
{
    use HasFactory;

    protected $table = 'report_crimes';

    function officers(){
        return $this->belongsTo(Officers::class);
    }
}
