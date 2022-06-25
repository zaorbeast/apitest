<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportTouristic extends Model
{
    use HasFactory;
    protected $table='report_touristics';
    protected $fillable=[
        'idUser',
        'Message',
        'idTouristic',
        'state'
    ];
}
