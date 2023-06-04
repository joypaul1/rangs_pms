<?php

namespace App\Models\PMS;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class KRAApporvedHistory extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
