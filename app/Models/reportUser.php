<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportUser extends Model
{
    use HasFactory;
    protected $table="report_users";
protected $fillable=[
    'idUser',
    'Message',
    'idReportedUser'
];
}
