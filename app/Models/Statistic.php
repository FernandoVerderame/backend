<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'date', 'apartment_id'];

    
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

}