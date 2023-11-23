<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    public function addOfficer()
    {
        return $this->belongsTo(AddOfficer::class, 'officer_id', 'id');
    }
    
}
