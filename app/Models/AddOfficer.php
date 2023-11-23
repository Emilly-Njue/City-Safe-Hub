<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOfficer extends Model
{
    public function officers()
    {
        return $this->hasMany(Officer::class, 'officer_id', 'id');
    }
}
