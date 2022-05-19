<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleList2 extends Model
{
    use HasFactory;
    
    protected $table = "schedules";
    protected $primaryKey = "scheduleID";
    protected $fillable =['scheduleName', 'scheduleUniversity', 'scheduleMail', 'schedulePhone'];
}
