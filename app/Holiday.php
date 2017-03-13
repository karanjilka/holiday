<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
	protected $table = 'holiday';

    protected $fillable = [
        'name', 'image', 'summary','description','summary','description','start_date','end_date','date_explanation','type','fixed'
    ];
}
