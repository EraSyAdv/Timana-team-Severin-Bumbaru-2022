<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialities extends Model
{
    use HasFactory;
    protected $table = "specialities";
    protected $primaryKey = "specialityID";
    protected $fillable = ['specialityName'];
}
