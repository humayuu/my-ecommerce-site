<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Function for Relationship with Division table
    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }

    // Function for Relationship with District table
    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }
}
