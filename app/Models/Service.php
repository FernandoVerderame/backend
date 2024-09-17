<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    /* RELAZIONE CON IL MODELLO APPARTAMENTI */
    public function apartments()
    {

        /* MOLTI APPARTAMENTI */
        return $this->belongsToMany(Apartment::class);
    }
}