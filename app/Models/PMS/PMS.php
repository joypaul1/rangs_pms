<?php

namespace App\Models\PMS;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoTimeStamp;

class PMS extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];
}
