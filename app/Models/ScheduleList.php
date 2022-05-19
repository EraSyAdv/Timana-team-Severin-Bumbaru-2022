<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleList extends Model
{
    use HasFactory;
    
    protected $table = "list_schedules";
    protected $primaryKey = "scheduleID";
    protected $fillable =['scheduleName', 'scheduleUniversity', 'scheduleMail', 'schedulePhone', 'scheduleCode'];
}
