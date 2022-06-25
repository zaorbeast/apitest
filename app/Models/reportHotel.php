<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportHotel extends Model
{
    use HasFactory;
    protected $table='report_hotels';
    protected $fillable=[
        'idUser',
        'Message',
        'idhotel',
        'state'
    ];
}
