<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HolidaySubscriber extends Model
{
    protected $table = 'holiday_subscriber';

    protected $fillable = [
        'email_id', 'daily_preference', 'weekly_preference','monthly_preference','active'
    ];
}
