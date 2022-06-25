<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportHouse extends Model
{
    use HasFactory;
    protected $table='report_houses';
    protected $fillable=[
        'idUser',
        'Message',
        'idhouse',
        'state'
    ];

}
