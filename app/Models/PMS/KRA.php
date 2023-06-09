<?php

namespace App\Models\PMS;

use App\Traits\AutoTimeStamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KRA extends Model
{
    use AutoTimeStamp;
    protected $guarded = ['id'];

    /**
     * The activeYear that belong to the KRA
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activeYear(): BelongsTo
    {
        return $this->belongsTo(PMSYear::class, 'pms_year_id',  'id')->where('status', '1')->select('id','name');
    }
    /**
     * Get the year that owns the KRA
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function year(): BelongsTo
    {
        return $this->belongsTo(PMSYear::class, 'pms_year_id',  'id')->select('id', 'name');
    }


    /**
     * Get all of the kpi for the KRA
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kpi(): HasMany
    {
        return $this->hasMany(KPI::class, 'kra_id', 'id');
    }
}
