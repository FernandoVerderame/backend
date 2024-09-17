<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $fillable = ['code_ip', 'apartment_id'];


    /* RELAZIONE CON IL MODELLO APPARTAMENTI */
    public function apartment()
    {

        /* UN SOLO APPARTAMENTO */
        return $this->belongsTo(Apartment::class);
    }
}
